<?php

// Add this route to web.php temporarily for debugging
// Route::get('/debug/paypal', function () {
//     return view('debug.paypal');
// });

// PayPal Debug Endpoint - Add this to PaypalController.php temporarily

/*
public function testCredentials()
{
    try {
        $accessToken = $this->getPayPalAccessToken();
        return response()->json([
            'success' => true,
            'message' => 'PayPal credentials are valid',
            'token' => substr($accessToken, 0, 20) . '...',
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
}
*/
