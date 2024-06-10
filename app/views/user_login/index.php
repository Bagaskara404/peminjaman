<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Peminjaman Buku Perpustakaan | Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?= BASEURL; ?>/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= BASEURL; ?>/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= BASEURL; ?>/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- THEME STYLES-->
    <link href="<?= BASEURL; ?>/assets/css/user/user.css" rel="stylesheet" />

</head>

<body>
    <div class="menu-container">
        <nav>
            <div class="logo-container">
                <img src="<?= BASEURL; ?>/assets/img/Logo.png" alt="Logo77">
                <div class="urlib-text">
                    <p>Urlib</p>
                </div>
            </div>

            <div class="menu">
                <div class="menu-menu">
                    <input type="search" id="search-input" placeholder="Type to search...">
                </div>
                <div class="menu-menu">
                    <span class="menu-text">
                        <span><a href="">Perpustakaan</a></span>
                    </span>
                    <div class="menu-menu2">
                        <span class="menu-text2">
                            <span><a href="">Koleksi</a></span>
                        </span>
                    </div>
                    <div class="menu-menu3">
                        <span class="menu-text3">
                            <span><a href="">Sign Up</a></span>
                        </span>
                    </div>
                    <div class="logo-home">
                        <svg width="30" height="24" viewBox="0 0 30 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.6023 6.38759L5.0004 14.2958V22.8311C5.0004 23.0521 5.08819 23.2641 5.24445 23.4203C5.40072 23.5766 5.61267 23.6644 5.83366 23.6644L11.6697 23.6493C11.8899 23.6482 12.1008 23.5599 12.2562 23.4038C12.4116 23.2476 12.4988 23.0363 12.4988 22.816V17.8315C12.4988 17.6105 12.5866 17.3986 12.7428 17.2423C12.8991 17.086 13.111 16.9982 13.332 16.9982H16.6651C16.8861 16.9982 17.0981 17.086 17.2543 17.2423C17.4106 17.3986 17.4984 17.6105 17.4984 17.8315V22.8124C17.498 22.922 17.5193 23.0306 17.5611 23.132C17.6028 23.2334 17.6641 23.3256 17.7415 23.4033C17.8189 23.4809 17.9109 23.5425 18.0122 23.5846C18.1134 23.6266 18.222 23.6482 18.3317 23.6482L24.1656 23.6644C24.3866 23.6644 24.5985 23.5766 24.7548 23.4203C24.9111 23.2641 24.9989 23.0521 24.9989 22.8311V14.2901L15.3991 6.38759C15.2862 6.29662 15.1456 6.24701 15.0007 6.24701C14.8557 6.24701 14.7151 6.29662 14.6023 6.38759ZM29.7693 11.7627L25.4155 8.17391V0.960401C25.4155 0.794654 25.3496 0.635695 25.2324 0.518494C25.1152 0.401292 24.9563 0.335449 24.7905 0.335449H21.8741C21.7083 0.335449 21.5494 0.401292 21.4322 0.518494C21.315 0.635695 21.2491 0.794654 21.2491 0.960401V4.74188L16.5865 0.905718C16.139 0.537506 15.5775 0.336185 14.9981 0.336185C14.4186 0.336185 13.8571 0.537506 13.4096 0.905718L0.226805 11.7627C0.163522 11.815 0.111165 11.8793 0.0727266 11.9518C0.0342879 12.0244 0.0105204 12.1038 0.00278216 12.1855C-0.0049561 12.2672 0.00348653 12.3497 0.0276277 12.4282C0.0517688 12.5066 0.0911353 12.5796 0.143478 12.6428L1.4715 14.2573C1.5237 14.3208 1.58791 14.3733 1.66044 14.4119C1.73298 14.4506 1.81242 14.4745 1.89422 14.4824C1.97603 14.4903 2.05858 14.482 2.13716 14.4579C2.21574 14.4338 2.2888 14.3945 2.35216 14.3422L14.6023 4.25234C14.7151 4.16137 14.8557 4.11176 15.0007 4.11176C15.1456 4.11176 15.2862 4.16137 15.3991 4.25234L27.6497 14.3422C27.7129 14.3945 27.7859 14.4339 27.8644 14.458C27.9428 14.4822 28.0253 14.4906 28.107 14.4829C28.1888 14.4751 28.2682 14.4514 28.3407 14.4129C28.4133 14.3745 28.4775 14.3221 28.5298 14.2589L29.8579 12.6444C29.9101 12.5808 29.9493 12.5075 29.9732 12.4286C29.9971 12.3498 30.0051 12.2671 29.9969 12.1851C29.9886 12.1032 29.9643 12.0237 29.9253 11.9512C29.8862 11.8787 29.8332 11.8146 29.7693 11.7627Z"
                                fill="#444B59" />
                        </svg>
                    </div>
                </div>
        </nav>
    </div>
    <div class="main-content">
        <div class="login-login">
            <div class="text-login">
                <h1>WELCOME BACK!</h1>
                <P>Don't have an account, <span><a href="">Sign Up</a></span></P>

            </div>

            <div class="login-input-field">
                <form action="" method="POST">
                    <div class="login-input">
                        <label>Username</label>
                        <input type="text" class="usr">
                    </div>
                    <div class="pass-input">
                        <label>Password</label>
                        <input type="text" class="usr">
                    </div>
                    <button type="submit" class="btn">Sign In</button>
                </form>

            </div>
        </div>
        <div class="img">
            <img src="<?= BASEURL; ?>/assets/img/Group.png" alt="">
        </div>
    </div>


</body>

</html>