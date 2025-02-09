<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="create1.css?v=1.0.4" />
</head>
<body>
    <div id="box1">
        <form action="#" id="createAccountForm" enctype="multipart/form-data">
            <div class="divinput">
                <h1>CREATE ACCOUNT</h1>
            </div>
            <div class="divinput" id="Userdiv">
                <div class="container">
                    <input
                        required=""
                        type="text"
                        name="username"
                        class="input"
                        id="username" />
                    <label class="label">Username</label>
                </div>
            </div>
            <div class="divinput" id="Emaildiv">
                <div class="container">
                    <input
                        required=""
                        type="email"
                        name="email"
                        class="input"
                        id="email" />
                    <label class="label">Email</label>
                </div>
            </div>
            <div class="divinput" id="Passdiv">
                <div class="container">
                    <input
                        required=""
                        type="password"
                        name="password"
                        class="input"
                        id="password" />
                    <label class="label">Password</label>
                </div>
            </div>
            <div class="divinput" id="divcreatebtn">
                <button class="btn" id="createAccount" type="submit">
                    <i class="animation"></i>Create new account<i class="animation"></i>
                </button>
            </div>
        </form>
    </div>
</body>
<script src="alert.js?v=1.0.3"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>