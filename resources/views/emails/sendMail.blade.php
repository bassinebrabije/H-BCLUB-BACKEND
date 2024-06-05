
 <!DOCTYPE html>
<html>

<head>
    <title></title>
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

        /* Header Styles */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header a {
            text-decoration: none;
        }

        /* Nav Styles */
        nav {
            display: flex;
            gap: 1.5rem;
            /* equivalent to 6 */
        }

        nav a {
            font-size: 0.875rem;
            /* equivalent to text-sm */
            color: #4b5563;
            /* equivalent to text-gray-600 */
            transition-property: color;
            transition-duration: 0.3s;
        }

        nav a:hover {
            color: #3b82f6;
            /* equivalent to hover:text-blue-500 */
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
    <!-- HIDDEN PREHEADER TEXT -->

    <section class="max-w-2xl px-6 py-8 mx-auto bg-white">
        <main class="mt-8">
            <img class="object-cover w-full h-56 rounded-lg md:h-72" src="https://i.ibb.co/4FTr95g/Testimonial.png"
                alt="">

            <h2 class="mt-6 text-gray-700">Hi  {{ $details['fullName'] }},</h2>

            <p class="mt-2 leading-loose text-gray-600">
                Thank you for choosing HBGYM! Your registration marks the beginning of an exciting journey towards
                better health and
                fitness. We're thrilled to have you join our community. Get ready to unlock your full potential and
                achieve your fitness
                goals with us!
            </p>

            <p class="mt-2 text-gray-600">
                Thanks, <br>
                HB GYM
            </p>


        </main>


        <footer class="mt-8">
            <p class="mt-3 text-gray-500">© 2024 HB GYM. All Rights Reserved.</p>
        </footer>
    </section>

</body>

</html>