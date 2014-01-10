<link type="text/css" href="./../../public/css/bootstrap.css" rel="stylesheet" >
<!-- <link type="text/css" href="./../public/css/feg.css" rel="stylesheet" > -->
<page backtop="30mm" backbottom="7mm" backleft="0mm" backright="10mm"> 
    <page_header> 
        <table class="t_header">
            <tr>
                <td><img src="./img/feg.png" alt=""></td>
                <td><h4 class="bold"><?php echo $enTete; ?></h4></td>
            </tr>
        </table>
    </page_header> 
    <page_footer> 
        Page Footer 
    </page_footer> 
    
    <table class="t_title">
        <tr>
            <td colspan="2" class="full_width_table titre3 bold"><?php echo $titre1 ?></td>
        </tr>
        <tr>
            <td colspan="2" class="full_width_table titre1 bold"><?php echo $titre2 ?></td>
        </tr>
        <tr>
            <td class="fifty_width_table border-top-none border-right-none titre2 bold" text-align="center"><?php echo $titre3 ?></td>
            <td class="fifty_width_table border-top-none titre2 bold"><img src="./img/miage.png" alt=""></td>
        </tr>
        <tr>
            <td class="titre4 bold" colspan="2"><?php echo $titre4 ?></td>
        </tr>
    </table>
    <br>
    <form action="">
        <input type="checkbox" value="titulaire1"><?php echo $titulaire1 ?><br>
        <input type="checkbox" value="titulaire2"><?php echo $titulaire2 ?><br>
        <input type="checkbox" value="titulaire3"><?php echo $titulaire3 ?><br>
    </form>
    <br>
    <p class="note"><?php echo $note ?></p>
    <br>
    <div class="titre_encadre">CANDIDAT</div class="titre">
</page> 