<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/output.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
    <title>Document</title>
</head>

<body>

    <div class="mx-auto w-1/2 px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg">
            <form action="<?= base_url('/register/save') ?>" method="post"
                class="mb-0 mt-6 bg-white space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8">
                <p class="text-center text-lg font-medium">Sign up</p>
                <div>
                    <label for="username" class="sr-only">Username</label>
                    <div class="relative">
                        <input type="text" name="name"
                            class="w-full outline-none rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="Enter Username" />
                    </div>
                </div>
                <div>
                    <label for="email" class="sr-only">Email</label>
                    <div class="relative">
                        <input type="email" name="email"
                            class="w-full outline-none rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="Enter email" />
                    </div>
                </div>

                <div>
                    <label for="password" class="sr-only">Password</label>
                    <div class="relative">
                        <input type="password" name="password"
                            class="w-full outline-none rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="Enter password" />
                    </div>
                </div>
                <div>
                    <label for="confpassword" class="sr-only">Password</label>
                    <div class="relative">
                        <input type="password" name="confpassword"
                            class="w-full outline-none rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="Confirm Password" />
                    </div>
                </div>
                <?php if (isset($error)): ?>
                    <div class="error">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <button type="submit"
                    class="block w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">
                    Sign in
                </button>

                <p class="text-center text-sm text-gray-500">Already Have account?
                    <a class="underline" href="/login">Sign in</a>
                </p>
            </form>
        </div>
    </div>

</body>

</html>