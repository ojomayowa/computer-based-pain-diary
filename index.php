<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Pain Diary - Login Page </title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="css/alerts.css" rel="stylesheet">
</head>

<body class="bg-green-700">
    <div class="grid md:grid-cols-3">
        <div class=""></div>
        <div class="mt-20 col-start-2 col-span-1">
            <div class="w-full text-center text-white text-2xl font-bold">
                PAIN DIARY
            </div>
            <div class="mt-8">
                <div class="w-full text-center text-white text-sm font-bold">
                    Login Page
                </div>
                <?php require_once "handlers/alerts.php"; ?>
                <form action="handlers/auth/login.php" method="post">
                    <div class="grid grid-cols-1 gap-6 mx-auto">
                        <label class="block">
                            <span class="text-white"> Email Address </span>
                            <input tabindex="1" type="email" name="email" class="h-10 outline-none block p-2 w-full" required>
                        </label>

                        <label class="block">
                            <span class="text-white"> Password </span>
                            <input type="password" name="password" class="h-10 outline-none block w-full p-2" required>
                        </label>
                        <input type="submit" class="mt-4 h-15 bg-green-500 text-black w-full outline-none p-2 hover:text-white" value="LOGIN">
                        <div class="w-full text-white text-sm font-bold"> <a href="register.php" class="hover:text-black">Register here</a> </div>
                    </div>
                </form>
            </div>
        </div>
        <div class=""></div>
    </div>
</body>

</html>