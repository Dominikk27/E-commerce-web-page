<?php
    require __DIR__.'/php/productsData.php';
    require __DIR__.'/php/pages.php';


    $totalProducts = readProducts();
    $itemsPerPage = 30;
    $page = getCurrentPage();

    $totalPages = getTotalPages(count($totalProducts),$itemsPerPage);

    $products = paginate($totalProducts, $page, $itemsPerPage);

    $paginationPages = getPaginationPages($page, $totalPages, 3);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Styles/global.css">
        <script src="https://kit.fontawesome.com/aeaa451863.js" crossorigin="anonymous"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Document</title>
    </head>
    <body class="bg-[var(--color-background)]">
        <div class="relative w-full h-screen xl:max-w-[1920px] mx-auto ">
            <!-- HEADER + NAV -->
            <div class="relative z-10 grid grid-cols-1 md:grid-cols-8 lg:grid-cols-12 px-[var(--horizontal-gap)] py-[8rem] gap-4 sm:px-[16px] md:px-[4rem] lg:px-[8rem] xl:px-[16rem] justify-center  max-w-[1600px] mx-auto">
                <!-- DESKTOP HEADER NAV BAR -->
                <div class="hidden absolute top-0 w-full lg:flex flex-col gap-5 p-4">
                    <!-- HEADER INFO BAR -->
                    <div class="flex flex-row justify-end gap-4">
                        <!-- INFO BAR BUSINESS HOURS -->
                        <div class="flex flex-row justify-center items-center gap-2 bg-[rgba(var(--color-filled-card-rgba),0.4)] px-4 py-4 rounded-[1rem]">
                            <div class="icon">
                                <i class="fa-solid fa-clock text-[var(--color-accent)] text-[1.7rem]"></i>
                            </div>
                            <div class="flex flex-col justify-center items-center">
                                <h1 class="h1Text justify-center items-center  text-white px-[0.5rem]">Otváracie hodiny</h1>
                                <h2 class="h2text text-white">Po-Pia: 8:00-16:30</h2>
                            </div>
                        </div>
                        <!-- INFO BAR PHONE NUMBER -->
                        <div class="flex flex-row justify-center items-center gap-2 bg-[rgba(var(--color-filled-card-rgba),0.4)] px-4 py-4 rounded-[1rem]">
                            <div class="icon">
                                <i class="fa-solid fa-phone text-[var(--color-accent)] text-[1.7rem]"></i>
                            </div>
                            <div class="flex flex-col justify-center items-center">
                                <h1 class="h1Text justify-center items-center  text-white px-[0.5rem]">Telefón</h1>
                                <h2 class="h2text text-white">+421 918 523 756</h2>
                            </div>
                        </div>
                        <!-- INFO BAR EMAIL -->
                        <div class="flex flex-row justify-center items-center gap-2 bg-[rgba(var(--color-filled-card-rgba),0.4)] px-4 py-4 rounded-[1rem]">
                            <div class="icon">
                                <i class="fa-solid fa-at text-[var(--color-accent)] text-[1.7rem]"></i>
                            </div>
                            <div class="flex flex-col justify-center items-center">
                                <h1 class="h1Text justify-center items-center  text-white px-[0.5rem]">E-mail</h1>
                                <h2 class="h2text text-white">rmtechnikmyjava@gmail.com</h2>
                            </div>
                        </div>
                    </div>
                    <!-- NAVIGATION -->
                    <div class="flex flex-row gap-4 w-full bg-[rgba(var(--color-accent-rgb),0.4)] py-2 px-2 rounded-[0.5rem]">
                        <a href="/#domov" class="h2text text-[1.2rem] text-white relative after:block after:h-[2px] after:w-0 after:bg-[var(--color-accent)] after:transition-all after:duration-300 hover:after:w-full">
                            Domov
                        </a>
                        <a href="/#o-nas" class="h2text text-[1.2rem] text-white relative after:block after:h-[2px] after:w-0 after:bg-[var(--color-accent)] after:transition-all after:duration-300 hover:after:w-full">
                            O nás
                        </a>
                        <a href="/#partneri" class="h2text text-[1.2rem] text-white relative after:block after:h-[2px] after:w-0 after:bg-[var(--color-accent)] after:transition-all after:duration-300 hover:after:w-full">
                            Partneri
                        </a>
                        <a href="https://profitrend.elnot.com/" class="h2text text-[1.2rem] text-white relative after:block after:h-[2px] after:w-0 after:bg-[var(--color-accent)] after:transition-all after:duration-300 hover:after:w-full">
                            Servis
                        </a>
                        <a href="/#kontakt" class="h2text text-[1.2rem] text-white relative after:block after:h-[2px] after:w-0 after:bg-[var(--color-accent)] after:transition-all after:duration-300 hover:after:w-full">
                            Kontakt
                        </a>
                        
                    </div>
                </div>
            </div>
            <!-- MOBILE HAMBURGER BUTTON -->
            <div id="menuBtn"
                class="fixed z-[9999] top-0 left-0 w-[var(--menu-btn-size)] h-[var(--menu-btn-size)]
                        bg-[var(--color-accent)] rounded-[var(--menu-btn-radius)]
                        flex justify-center items-center m-[var(--menu-btn-padding)] lg:hidden">
                <i id="menuIcon" class="fa-solid fa-bars fa-xl"></i>
            </div>
            <!-- MOBILE MENU OVERLAY -->
            <div id="mobileMenu"
                class="fixed inset-0 bg-[rgba(var(--color-filled-card-rgba),0.85)]
                        backdrop-blur-md flex flex-col justify-center items-center gap-8
                        z-[99] opacity-0 pointer-events-none transition-all duration-300 lg:hidden">
                
                <a href="/" class="text-white text-2xl font-semibold">Domov</a>
                <a href="#o-nas" class="text-white text-2xl font-semibold">O nás</a>
                <a href="#partneri" class="text-white text-2xl font-semibold">Partneri</a>
                <a href="https://profitrend.elnot.com/" class="text-white text-2xl font-semibold">Servis</a>
                <a href="#kontakt" class="text-white text-2xl font-semibold">Kontakt</a>
            </div>
    
            <!-- PRODUCTS -->
            <div id="store" class="flex flex-col justify-center w-full h-auto pb-5 px-[var(--horizontal-gap)] sm:px-[16px] md:px-[4rem] lg:px-[8rem] xl:px-[16rem]  max-w-[1600px] mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                    <!-- GENERATE CARDS -->
                    <?php foreach($products as $product): ?>
                        <!-- PRODUCT CARD! -->
                        <div class="relative w-50 h-auto pb-3 rounded-xl flex flex-col product-card justify-center items-center">
                            <div class="image-wrapper aspect-square overflow-hidden flex justify-center items-center bg-white mx-3 my-3 border-solid border-2 rounded-lg">
                                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class=" w-full h-auto object-contain">
                            </div>
                            <div class="w-full">
                                <div class="px-4">
                                    <h3 class="font-bold"><?= htmlspecialchars($product['name']) ?></h3>
                                    <div class="details flex">
                                        <ul>
                                            <?php 
                                                $i = 0;
                                                foreach ($product['parameters'] as $name => $value): 
                                                    if ($i++ >= 3) break;
                                                ?>
                                                    <li class="text-sm">
                                                        <span class="font-medium text-sm"><?= htmlspecialchars($name) ?>:</span>
                                                        <?= htmlspecialchars($value) ?>
                                                    </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex justify-between w-full gap-2 items-center pt-5 px-2">
                                    <div class="flex w-full flex-1 justify-center">
                                        <p class="font-bold text-xl"><?= htmlspecialchars($product['price']) ?> €</p>
                                    </div>
                                    <button class="h-full px-3 py-2 detail-btn  rounded-full text-sm">Detaily Produktu</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
                <div class="flex justify-center items-center pt-10 gap-1 w-full">
                    <?php foreach ($paginationPages as $p): ?>
                        <?php if ($p === '...'): ?>
                            <span class="px-3 py-2 text-gray-400">…</span>

                        <?php else: ?>
                            <a
                                href="?page=<?= $p ?>"
                                class="px-2 py-1 rounded
                                    <?= $p === $page
                                        ? 'bg-[var(--color-accent)] text-white font-bold'
                                        : 'bg-gray-200 hover:bg-gray-300'
                                    ?>"
                            >
                                <?= $p ?>
                            </a>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </div>

            </div>
            
        </div>
        <script src="./js/mobileMenu.js"></script>
    </body>
</html>