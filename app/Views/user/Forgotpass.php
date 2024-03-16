<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <link rel="shortcut icon" href="<?= base_url('/favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('css/output.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/ForgotPass.css') ?>">
    <title>ForgotPassword - Askify</title>
</head>


<body>

    <div class="mx-auto w-1/2 px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg">



            <form method="post" action="<?= base_url('/forgot-password') ?>"
                class="mb-0 mt-6 bg-white space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8">
                <p class="text-center text-lg font-medium">Forgot Password</p>

                <div>
                    <label for="email" class="sr-only">Email</label>

                    <div class="relative">
                        <input type="email" name="email"
                            class="w-full outline-none rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="Enter email" />


                    </div>
                </div>
                <div class="text-center text-red-700 ">
                    <?= session()->getFlashdata('error') ?>
                </div>
                <button type="submit"
                    class="block w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">
                    Submit
                </button>

        </div>

    </div>
    </div>

</body>

</html>