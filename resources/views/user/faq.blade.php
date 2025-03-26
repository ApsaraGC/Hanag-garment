<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Hanag Garment</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your Hanag Garment CSS -->
    <style>
        /* General Layout */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* FAQ Section */
.faq-page {
    background-color: #fff;
    padding: 30px 0;
}

.container {
    width: 80%;
    margin: 0 auto;
}

.page-title {
    font-size: 32px;
    color: #2c3e50;
    text-align: center;
    margin-bottom: 30px;
}

.faq-list {
    background-color: #ecf0f1;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.faq-item {
    margin-bottom: 20px;
    padding: 15px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.faq-question {
    font-size: 18px;
    color: #2980b9;
    margin: 0;
    font-weight: bold;
}

.faq-answer {
    font-size: 16px;
    color: #34495e;
    margin-top: 8px;
}



    </style>
</head>
<body>
    @include('layouts.navigation')

    <main class="faq-page">
        <div class="container">
            <h2 class="page-title">Frequently Asked Questions</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <h3 class="faq-question">What is Hanag Garment?</h3>
                    <p class="faq-answer">Hanag Garment offers high-quality clothes at affordable prices, designed to suit all styles and preferences.</p>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">Do you offer home delivery?</h3>
                    <p class="faq-answer">Yes, we provide home delivery service for all orders within the specified regions.</p>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">What sizes do you offer?</h3>
                    <p class="faq-answer">We offer a wide range of sizes, from small to extra-large, to ensure the perfect fit for everyone.</p>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">Can I return or exchange an item?</h3>
                    <p class="faq-answer">Yes, we accept returns and exchanges within 14 days of purchase. Please refer to our returns policy for more details.</p>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">How do I track my order?</h3>
                    <p class="faq-answer">Once your order is shipped, you will receive a tracking number via email to track your delivery online.</p>
                </div>
            </div>
        </div>
    </main>
    @include('layouts.footer')

</body>
</html>
