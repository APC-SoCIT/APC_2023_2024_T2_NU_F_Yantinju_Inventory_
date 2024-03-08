
<style>
.nav ul {
    display: none;
    list-style: none;
    padding-left: 0;
    margin-top: 5px;
}

.nav ul li {
    padding-left: 20px;
}

.nav li.active ul {
    display: block;
    animation: slideDown 0.3s ease forwards;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.nav li.active > a .fa-angle-right {
    transform: rotate(90deg);
}
</style>

<div class="container bootdey">
    <div class="col-md-3" style="margin-top: 10.5rem;">
        <section class="panel">
            <!--<div class="panel-body">
                <input type="text" placeholder="Keyword Search" class="form-control" />
            </div>-->
        </section>
        <section class="panel">
            <header class="panel-heading">
                Category
            </header>
            <div class="panel-body">
                <ul class="nav prod-cat">
                    <li>

                    <?php
                    $login = $_GET['confirm'];
                    if($login == 'notlogged_in') {
                    ?>  
                        <a href="#" class="<?php if (isset($_GET['all'])) {echo "active";} ?>"><i class="fa fa-angle-right"></i> All</a>
                        <ul class="nav">
                        <li class="<?php if (isset($_GET['necklace'])) {echo "active";} ?>"><a href="products.php?Necklaces&confirm=notlogged_in">- Necklaces</a></li>
                        <li class="<?php if (isset($_GET['bracelet'])) {echo "active";} ?>"><a href="products.php?Bracelets&confirm=notlogged_in">- Bracelets</a></li>
                        <li class="<?php if (isset($_GET['ring'])) {echo "active";} ?>"><a href="products.php?Rings&confirm=notlogged_in">- Rings</a></li>
                        <li class="<?php if (isset($_GET['pendant'])) {echo "active";} ?>"><a href="products.php?Pendants&confirm=notlogged_in">- Pendants</a></li>
                        <li class="<?php if (isset($_GET['earring'])) {echo "active";} ?>"><a href="products.php?Earrings&confirm=notlogged_in">- Earrings</a></li>
                        <li class="<?php if (isset($_GET['all'])) {echo "active";} ?>"><a href="products.php?All&confirm=notlogged_in"><b>- Show All</b></a></li>
                        </ul>
                    <?php
                    }else {
                    ?>
                        <a href="#" class="<?php if (isset($_GET['all'])) {echo "active";} ?>"><i class="fa fa-angle-right"></i> All</a>
                        <ul class="nav">
                        <li class="<?php if (isset($_GET['necklace'])) {echo "active";} ?>"><a href="products.php?Necklaces&confirm=logged_in">- Necklaces</a></li>
                        <li class="<?php if (isset($_GET['bracelet'])) {echo "active";} ?>"><a href="products.php?Bracelets&confirm=logged_in">- Bracelets</a></li>
                        <li class="<?php if (isset($_GET['ring'])) {echo "active";} ?>"><a href="products.php?Rings&confirm=logged_in">- Rings</a></li>
                        <li class="<?php if (isset($_GET['pendant'])) {echo "active";} ?>"><a href="products.php?Pendants&confirm=logged_in">- Pendants</a></li>
                        <li class="<?php if (isset($_GET['earring'])) {echo "active";} ?>"><a href="products.php?Earrings&confirm=logged_in">- Earrings</a></li>
                        <li class="<?php if (isset($_GET['all'])) {echo "active";} ?>"><a href="products.php?All&confirm=logged_in"><b>- Show All</b></a></li>
                        </ul>
                    <?php
                    }
                    ?>
                    </li>
                    
                </ul>
            </div>
        </section>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var dropdowns = document.querySelectorAll('.prod-cat > li > a');
    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', function(event) {
            event.preventDefault();
            var parent = dropdown.parentNode;
            if (parent.classList.contains('active')) {
                parent.classList.remove('active');
            } else {
                closeAllDropdowns();
                parent.classList.add('active');
            }
        });
    });

    function closeAllDropdowns() {
        var dropdowns = document.querySelectorAll('.prod-cat > li');
        dropdowns.forEach(function(dropdown) {
            dropdown.classList.remove('active');
        });
    }
});
</script>