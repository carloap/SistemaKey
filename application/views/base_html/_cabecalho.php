<?php // incluir barra lateral antes da construção do container principal
// isso dispensa chamar uma view, mas provavelmente eu terei que tirar isso, pq pode virar uma merda depois!
include '_sidebar.php'; ?>

<div id="container">
    <header class='main_header'>
        <!-- <section class="header_logo">
            <div class='header'>
                <div id='logo'>
                    <a href='<?php //echo BASEURL; ?>'>
                        <img src='<?php //echo BASEURL; ?>resources/img/logo.png' width='311' height='57' alt='' />
                    </a>
                </div>
            </div>
        </section>
        -->
        <section id='topo' class="navigator gradient fixar">
            <nav>
                <div class='nav'>
                    <ul>
                        <li><a class='<?php echo (getClass()=='index'||getClass()==''? 'current_menu': ''); ?>' href='<?php echo BASEURL; ?>'>Firmas</a></li>
                        <li><a class='<?php echo (getClass()=='quemsou'? 'current_menu': ''); ?>' href='<?php echo BASEURL; ?>quemsou'>Balcão</a></li>
                        <li><a class='<?php echo (getClass()=='servicos'? 'current_menu': ''); ?>' href='<?php echo BASEURL; ?>servicos'>Cobrança</a></li>
                        <li><a class='<?php echo (getClass()=='portfolio'? 'current_menu': ''); ?>' href='<?php echo BASEURL; ?>portfolio'>Data sistema</a></li>
                        <li><a class='<?php echo (getClass()=='contato'? 'current_menu': ''); ?>' href='<?php echo BASEURL; ?>contato'>Configuração</a></li>
                        <li><a class='<?php echo (getClass()=='contato'? 'current_menu': ''); ?>' href='<?php echo BASEURL; ?>contato'>Sair</a></li>
                    </ul>
                </div>
            </nav>
        </section>
    </header>
    <div class='main_content contSegmentado'>
   