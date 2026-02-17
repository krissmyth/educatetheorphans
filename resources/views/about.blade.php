@extends('layouts.public')

@section('title', 'About Us - ETO Ministries')

@section('content')
<div class="about-hero">
    <div class="container">
        <h1>About ETO Ministries</h1>
        <p class="lead">Transforming Lives Through Education and Care</p>
    </div>
</div>

<div class="about-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2>Our Mission</h2>
                <p>ETO Ministries (Educate the Orphans) is a small, Christian charity working in Kenya to support orphaned and needy children. Our mission is simple yet profound: to feed, clothe, and educate destitute children, with a strong emphasis on education.</p>
                <p>Rather than operating a traditional orphanage, we partner with extended families to care for children while providing the financial support needed to ensure they receive proper nutrition, clothing, and quality education.</p>
            </div>
            <div class="col-lg-6">
                <h2>Our Approach</h2>
                <p>We believe in sustainable, family-centered solutions. Children remain with their families and extended relatives while we cover the costs of their care and education. This approach:</p>
                <ul>
                    <li>Maintains family bonds and cultural connections</li>
                    <li>Supports entire family units</li>
                    <li>Builds strong community relationships</li>
                    <li>Ensures lasting impact and stability</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="about-section bg-light">
    <div class="container">
        <h2>Our Impact</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="stat-box">
                    <h3>Since 1990</h3>
                    <p>Working in Kenya's Tharaka region for over 30 years</p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="stat-box">
                    <h3>7 Schools</h3>
                    <p>Operating education programs across multiple locations</p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="stat-box">
                    <h3>3,000+ Children</h3>
                    <p>Currently supported and receiving care and education</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about-section">
    <div class="container">
        <h2>Success Stories</h2>
        <p>The true measure of our success is visible in the lives of those we've helped. Many former beneficiaries of ETO Ministries are now fully employed in meaningful roles, including:</p>
        <ul class="success-list">
            <li>Teachers educating the next generation</li>
            <li>Pastors serving their communities</li>
            <li>Government officials at county and national levels</li>
            <li>Clergy members in their churches</li>
            <li>Professionals working with Kenya's presidential office</li>
        </ul>
        <p>These individuals represent the lasting impact of education and support on children's futures.</p>
    </div>
</div>

<div class="about-section bg-light">
    <div class="container">
        <h2>How We're Registered</h2>
        <p>ETO Ministries is a registered charity with legitimacy and accountability across multiple regions:</p>
        <ul>
            <li><strong>UK Registration:</strong> Registered UK Charity</li>
            <li><strong>Ireland Registration:</strong> Registered Irish Charity</li>
            <li><strong>Kenya Registration:</strong> Registered in Kenya (Charity no. 102736 in Northern Ireland)</li>
        </ul>
        <p>Our registration ensures transparency, accountability, and trust in how we manage resources and serve our community.</p>
    </div>
</div>

<div class="about-section">
    <div class="container">
        <h2>How You Can Help</h2>
        <p>Your support makes a direct, measurable difference in children's lives. We offer several ways to get involved:</p>
        <div class="row">
            <div class="col-md-6">
                <h4>Child Sponsorship</h4>
                <p>Sponsor a child and provide ongoing support for their education, nutrition, and care. We encourage direct communication with the children you support.</p>
            </div>
            <div class="col-md-6">
                <h4>Donations</h4>
                <p>Make a one-time or recurring donation to support our programs and reach more children in need.</p>
            </div>
        </div>
        <p class="text-center mt-4">
            <a href="https://justgiving.com/eto/donate" class="btn btn-primary btn-lg" target="_blank">Make a Donation</a>
        </p>
    </div>
</div>

<style>
.about-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 80px 0;
    text-align: center;
}

.about-hero h1 {
    font-size: 3em;
    margin-bottom: 10px;
}

.about-hero .lead {
    font-size: 1.5em;
    margin: 0;
}

.about-section {
    padding: 60px 0;
}

.about-section.bg-light {
    background-color: #f8f9fa;
}

.about-section h2 {
    margin-bottom: 30px;
    color: #333;
}

.stat-box {
    padding: 30px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.stat-box h3 {
    color: #667eea;
    font-size: 2em;
    margin-bottom: 10px;
}

.success-list {
    list-style: none;
    padding: 0;
}

.success-list li {
    padding: 10px 0;
    padding-left: 30px;
    position: relative;
}

.success-list li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #667eea;
    font-weight: bold;
}

.btn-primary {
    background-color: #667eea;
    border-color: #667eea;
}

.btn-primary:hover {
    background-color: #764ba2;
    border-color: #764ba2;
}
</style>
@endsection
