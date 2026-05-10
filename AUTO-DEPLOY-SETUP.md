# Auto-Deploy Setup — Educate the Orphans

Whenever you push to the `main` branch on GitHub, the live server will automatically pull the changes, rebuild assets, and clear caches.

---

## Step 1 — Create the Deploy Script on the Live Server

SSH into the server as root and run:

```bash
cat > /home/educatetheorphans/htdocs/educatetheorphans.com/public/deploy.php << 'DEPLOYEOF'
<?php
$secret = 'REPLACE_WITH_YOUR_SECRET';

$payload = file_get_contents('php://input');
$sig = 'sha256=' . hash_hmac('sha256', $payload, $secret);

if (!hash_equals($sig, $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '')) {
    http_response_code(403);
    exit('Forbidden');
}

$data = json_decode($payload, true);

// Only deploy on pushes to main branch
if (($data['ref'] ?? '') !== 'refs/heads/main') {
    exit('Not main branch — ignored');
}

$projectPath = '/home/educatetheorphans/htdocs/educatetheorphans.com';

$commands = [
    "cd {$projectPath} && git pull origin main 2>&1",
    "cd {$projectPath} && npm run build 2>&1",
    "cd {$projectPath} && php artisan view:clear 2>&1",
    "cd {$projectPath} && php artisan cache:clear 2>&1",
    "varnishadm ban req.url '~' '.' 2>&1",
];

$log = date('Y-m-d H:i:s') . " — Deploy triggered\n";

foreach ($commands as $cmd) {
    $output = shell_exec($cmd);
    $log .= "$ {$cmd}\n{$output}\n";
}

$log .= "--- Done ---\n\n";
file_put_contents('/tmp/deploy.log', $log, FILE_APPEND);

http_response_code(200);
echo 'Deployed successfully';
DEPLOYEOF
```

Then secure the file so it can only be read by the web server:

```bash
chmod 640 /home/educatetheorphans/htdocs/educatetheorphans.com/public/deploy.php
```

---

## Step 2 — Set Your Webhook Secret

Edit the deploy script and replace `REPLACE_WITH_YOUR_SECRET` with a strong secret string. Use this generated one (keep it private):

```
1931154419e9dabfaa68d2c634a4e5e37b2e033d
```

```bash
nano /home/educatetheorphans/htdocs/educatetheorphans.com/public/deploy.php
```

Find the line:
```php
$secret = 'REPLACE_WITH_YOUR_SECRET';
```
Change it to:
```php
$secret = '1931154419e9dabfaa68d2c634a4e5e37b2e033d';
```

Save with `Ctrl+X`, `Y`, `Enter`.

---

## Step 3 — Add the Webhook in GitHub

1. Go to your GitHub repo: `https://github.com/krissmyth/educatetheorphans`
2. Click **Settings** → **Webhooks** → **Add webhook**
3. Fill in:
   - **Payload URL**: `https://educatetheorphans.com/deploy.php`
   - **Content type**: `application/json`
   - **Secret**: `1931154419e9dabfaa68d2c634a4e5e37b2e033d`
   - **Which events?**: Just the push event
   - **Active**: ticked
4. Click **Add webhook**

GitHub will send a ping request — you should see a green tick confirming it connected.

---

## Step 4 — Test It

Make any small change locally, commit, and push to `main`:

```bash
git add .
git commit -m "Test auto-deploy"
git push origin main
```

Within a few seconds the live site should update. Check the deploy log on the server to confirm:

```bash
cat /tmp/deploy.log
```

---

## How It Works

```
You push to main on GitHub
        ↓
GitHub sends a POST request to https://educatetheorphans.com/deploy.php
        ↓
deploy.php verifies the secret signature (security check)
        ↓
Runs these commands on the server:
  1. git pull origin main      — pulls latest code
  2. npm run build             — compiles Tailwind CSS & JS
  3. php artisan view:clear    — clears cached Blade templates
  4. php artisan cache:clear   — clears application cache
  5. varnishadm ban ...        — purges Varnish cache
        ↓
Live site updated automatically
```

---

## Your Deploy Workflow Going Forward

1. Make changes locally
2. Test in browser at `http://localhost`
3. Commit to `dev` branch
4. Merge to `main` and push:
   ```bash
   git checkout main
   git merge dev
   git push origin main
   ```
5. Live site updates automatically within ~30 seconds

---

## Troubleshooting

**Webhook not triggering?**
- Check GitHub → Settings → Webhooks → click your webhook → Recent Deliveries
- A red X means the request failed — click it to see the error

**Deploy ran but site not updated?**
```bash
cat /tmp/deploy.log
```
This shows the full output of every command that ran.

**Manually trigger a deploy at any time:**
```bash
cd /home/educatetheorphans/htdocs/educatetheorphans.com
git pull origin main
npm run build
php artisan view:clear
php artisan cache:clear
varnishadm ban req.url '~' '.'
```
