<!DOCTYPE html>
<html>

<head>
    <title>Welcome to HBGYM</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        /* CSS styles for the given HTML structure */

        /* Section Styles */
        .max-w-2xl {
            max-width: 42rem;
            /* equivalent to 2xl */
        }

        .px-6 {
            padding-left: 1.5rem;
            /* equivalent to 6 */
            padding-right: 1.5rem;
            /* equivalent to 6 */
        }

        .py-8 {
            padding-top: 2rem;
            /* equivalent to 8 */
            padding-bottom: 2rem;
            /* equivalent to 8 */
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .bg-white {
            background-color: #fff;
        }

        /* Main Styles */
        main {
            margin-top: 2rem;
            /* equivalent to mt-8 */
        }

        /* Image Styles */
        img {
            object-fit: cover;
            width: 100%;
            height: 14rem;
            /* equivalent to h-56 */
            border-radius: 0.375rem;
            /* equivalent to rounded-lg */
        }

        /* Heading Styles */
        h2 {
            margin-top: 1.5rem;
            /* equivalent to mt-6 */
            color: #4b5563;
            /* equivalent to text-gray-700 */
        }

        /* Paragraph Styles */
        p {
            margin-top: 0.5rem;
            /* equivalent to mt-2 */
            line-height: 1.625;
            /* equivalent to leading-loose */
            color: #4b5563;
            /* equivalent to text-gray-600 */
        }

        /* Footer Styles */
        footer {
            margin-top: 2rem;
            /* equivalent to mt-8 */
        }

        /* Footer Paragraph Styles */
        footer p {
            color: #6b7280;
            /* equivalent to text-gray-500 */
        }

        /* Footer Anchor Styles */
        footer a {
            color: #3b82f6;
            /* equivalent to text-blue-600 */
            transition-property: color;
            transition-duration: 0.3s;
        }

        footer a:hover {
            text-decoration: underline;
            /* equivalent to hover:underline */
            color: #2563eb;
            /* slightly lighter blue */
        }
    </style>
</head>

<body>
    <section class="max-w-2xl px-6 py-8 mx-auto bg-white">
        <main class="mt-8">
            <img class="object-cover w-full h-56 rounded-lg md:h-72" src="https://i.ibb.co/4FTr95g/Testimonial.png" alt="">

            <h2 class="mt-6 text-gray-700">Hi {{ $details['fname'] }} {{ $details['lname'] }},</h2>

            <p class="mt-2 leading-loose text-gray-600">
                Thank you for choosing HBGYM in Casablanca! Your registration marks the beginning of an exciting journey with us as a valued admin. We're thrilled to have you join our team. Get ready to unlock your full potential and help us achieve our mission of promoting health and fitness within our community. Together, we'll achieve great things!
            </p>

            <p>Your account has been created successfully. Here are your account details:</p>

            <p>Url To Login: <a href="http://localhost:3000/">HBClub.ma</a></p>
            <p><strong>Username:</strong> {{ $details['username'] }}</p>
            <p><strong>Password:</strong> {{ $details['password'] }}</p>

            <p class="mt-2 text-gray-600">Thank you for joining us!</p>
            <p>HB GYM</p>
        </main>

        <footer class="mt-8">
            <p class="mt-3 text-gray-500">© {{ date('Y') }} Brabije&Hamer GYM. All Rights Reserved.</p>
        </footer>
    </section>
</body>

</html>
