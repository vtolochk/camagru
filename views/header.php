<link href="/views/css/header.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="screen" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/regular.css" integrity="sha384-zkhEzh7td0PG30vxQk1D9liRKeizzot4eqkJ8gB3/I+mZ1rjgQk+BSt2F6rT2c+I" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/brands.css" integrity="sha384-nT8r1Kzllf71iZl81CdFzObMsaLOhqBU1JD2+XoAALbdtWaXDOlWOZTR4v1ktjPE" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">
<header>
      <div class="banner">
        <i class="fab fa-grav"></i>
        <a id="banner-a" href="/">
        <div class="banner-text">Photo Creator</div>
        <div id="dot">.</div>
        </a>
      </div>
    <div class="header-button">
   
    <?php
    
		if (isset($_SESSION['user_id'])) {
      echo '<div id="login">' . $_SESSION['user_login'] . '</div>'; ?>
    <a href="/gallery"><button>Gallery</button></a>
    <a href="/makephoto"><button>Make photo</button></a>
    <a href="/settings"><button>Settings</button></a>
		<a href="/logout"><button>Logout</button></a>

	 <?php } else { ?>

      <a href="/enrollment">
        <button>Sign In</button>
      </a>

   <?php } ?>
   </div>
</header>