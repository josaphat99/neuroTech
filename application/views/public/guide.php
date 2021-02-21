<style>
    .not_connected{
        margin:50px;
    }
</style>
<?php
    //on doit verifier si l'utilisateur est connecté pour gerer l'affichage de la vue
    $class = '';
    if($this->session->connected)
    {
        $class = 'content';
    }else{
        $class = 'not_connected';
    }
?>
<section class="<?=$class?>">
    <header class="content__title">
        <h1><b>Guide d'utilisation</b></h1>              
    </header>
    <div class="card animated zoomIn">
        <p class="text-center" style="margin-top:20px;font-size:25px"><b>.neuroTech</b> </p> 
        <div class="card-body">
        <p style="font-size:15px"><b>1. Présentation de l'application</b></p>
        <div class="text-justify">
            <p style="line-height:25px"><b style="font-size:15px">neuroTech</b> 
                est une application conçue dans le but d’aider les personnes touchées par un déficit cognitif,
                 à faire de la stimulation cognitive à domicile. L’application est constituée de deux grande partie qui sont : 
                 la partie dédiée aux patients et la partie dédiée à l’admin qui s’occupe de gérer les exercices (ajouter, supprimer,…). Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio velit aut assumenda eos doloremque, est similique perferendis corporis, pariatur odit 
                 facere consequuntur laudantium vitae et non molestias repudiandae itaque natus. Lorem ipsum dolor sit amet consectetur 
                 adipisicing elit. Ipsum reiciendis provident ea, veritatis et vel ratione laboriosam explicabo eum quisquam impedit saepe ipsa
                 temporibus nemo error facilis. Nihil, perferendis ab.
            </p>
        </div>
        <p style="font-size:15px"><b>2. Comment utiliser l'application?</b></p>
        <div class="text-justify">
            <p style="line-height:25px">Pour commencer vous devez créer un compte utilisateur, puis vous authentifier afin d’avoir accès aux exercices. Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic nemo tenetur eligendi amet labore reprehenderit fugiat cum tempore libero numquam asperiores in at, vitae sint. Minus maxime vel consectetur quibusdam. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam molestiae 
            sed corporis doloribus reprehenderit aperiam, iste nihil commodi distinctio voluptas? Deserunt expedita dolorum nostrum culpa, 
            quaerat facere ipsa nam inventore? Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis fugiat natus vel adipisci sint quod, facilis accusantium.
             Laborum totam distinctio dolorem quaerat voluptate doloribus porro ipsam velit ipsum! Fuga, dicta?
            </p>
        </div>
        <p style="font-size:15px"><b>3. Comment repondre aux questions?</b></p>
        <div class="text-justify">
            <p style="line-height:25px">
            Le système contient des questions à choix multiples et des questions à réponse unique. La grande partie des questions montre un exemple de la manière dont vous pouvez y répondre. La plupart de questions à choix multiples montrent les assertions sous forme de listes déroulantes. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid corporis id praesentium aliquam, nihil porro consequatur, voluptatibus tempora quibusdam laudantium iure et temporibus modi ut cupiditate vel vitae delectus nulla? Lorem ipsum dolor sit amet consectetur adipisicing e
            lit. Ratione excepturi deleniti veritatis distinctio quaerat ipsum atque ex, ipsa assumenda, iure voluptas, quam dolore hic enim cupiditate molestiae voluptates fugit quis.
            </p>
        </div>
        <p style="font-size:15px"><b>4. Gestion de niveaux</b></p>
        <div class="text-justify">
            <p style="line-height:25px">
            Le système contient des questions à choix multiples et des questions à réponse unique. La grande partie des questions montre un exemple de la manière dont vous pouvez y répondre. La plupart de questions à choix multiples montrent les assertions sous forme de listes déroulantes. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid corporis id praesentium aliquam, nihil porro consequatur, voluptatibus tempora quibusdam laudantium iure et temporibus modi ut cupiditate vel vitae delectus nulla? Lorem ipsum dolor sit amet consectetur adipisicing e
            lit. Ratione excepturi deleniti veritatis distinctio quaerat ipsum atque ex, ipsa assumenda, iure voluptas, quam dolore hic enim cupiditate molestiae voluptates fugit quis.
            </p>
        </div>
    </div>
</section>