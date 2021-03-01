<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recommandation extends CI_Model
{
    public function __construct()
    {
        parent::__construct();        
        //===chargement des models===
        $this->load->model('Crud');
        $this->load->model('Exercice_model','exercice');
    }

    public function get_most()
    {
        $query = $this->db->query(
            'SELECT DISTINCT exercice_id, recommandation.id as id,titre, maximum, exercice.type, niveau.nom 
            FROM recommandation
            INNER JOIN exercice on recommandation.exercice_id = exercice.id
            INNER JOIN niveau on niveau.id = exercice.niveau_id
            ORDER BY recommandation.exercice_id'            
            );

        $tab = $query->result();        
        $ids_tab = [];
        //===Comptage du nombre d'occurence===
        for($i = 0; $i < count($tab); $i++)
        {   
            $exercice_id =  $tab[$i]->exercice_id;
            $counter = 0;

            for($j = 0; $j < count($tab); $j++)
            {
                if($tab[$j]->exercice_id == $exercice_id)
                {
                    $counter +=1;
                }
            }

            $ids_tab[$exercice_id] = $counter;
        }
        //===Tri a selection===
        for($i = 0; $i < count($tab); $i++)
        {   
            $max = $i;

            for($j = $i; $j < count($tab); $j++)
            {
                if($ids_tab[$tab[$max]->exercice_id] < $ids_tab[$tab[$j]->exercice_id])
                {
                    $max = $j;                    
                }
            }

            if($max != $i)
            {
                $tmp = $tab[$max];
                $tab[$max] = $tab[$i] ;
                $tab[$i] = $tmp;
            }
        }

        //===Selection unique===
        $final_data = [];
        $ids = [];

        for($i = 0; $i < count($tab); $i++)
        {
            if(!in_array($tab[$i]->exercice_id,$ids))
            {
                $ids [] = $tab[$i]->exercice_id;
                $final_data [] = $tab[$i];
            }
            
        }
        
        return $final_data;
    }

    //===Selectionner les recommandations: une occurence pour un exercice
    public function get_distinct()
    {
        $query = $this->db->query(
            'SELECT DISTINCT exercice_id
            FROM recommandation'           
        );

        return $query->result();  
    }

    //===creer une recommandation===//
    /**
     * Cette fonction prends en parametre le pourcentage
     * obtenu par le patient et l'indice du niveau du patient
     * on retournera false si il n'y a aaucun exercice dans le niveau recommandé et que
     * meme dans le meme niveau n'y a pas d'exercice
     * on retourne l'exercice recommandé o au cas ou on le trouverait
     */
//================================================================================>//
    public function create_recommandation($percent_got,$indice)
    {
        $recommandation = null;
        $niveau = $this->Crud->get_data('niveau',['indice'=>$indice])[0];

        if($percent_got >= 70)
        {
            //on recommande un exercice du niveau superieur
            $recommandation = $this->rc_70($indice,$niveau);            
        }
        else if($percent_got >= 50 && $percent_got <= 69){
            //selection d'un exercice du meme niveau
            $recommandation = $this->rc_same_level($niveau);
        }
        else{
            //selection d'un exercice du niveau inferieur
           $recommandation = $this->rc_50_69($indice,$niveau);
        }
        return $recommandation;
    }
//================================================================================>//

    //recommandation exercice du niveau inferieur
    public function rc_50_69($indice,$niveau)
    {
        $recommandation = null;

        if($indice == 1 || $indice == 2)
        {
            $niveau_inf = $this->Crud->get_data('niveau',['indice'=>$indice+1])[0];

            //verifions si il ya des exercices au niveau inf
            if(count($this->exercice->exercice_not_done($niveau_inf->id)) > 0)
            {
                $index = random_int(0,count($this->exercice->exercice_not_done($niveau_inf->id))-1);
                $recommandation = $this->exercice->exercice_not_done($niveau_inf->id)[$index];
            }            
            //s'il n'ya pas d'exercice on prend un exercice du mm niveau
            else{
                $recommandation = $this->rc_same_level($niveau); 
            }
        }
        //exercice du meme niveau 
        else if($indice == 3){
            $recommandation = $this->rc_same_level($niveau);
        }
        return $recommandation;
    }


    //recommandation exercice du niveau superieur
    public function rc_70($indice,$niveau)
    {
        $recommandation = null;
        //selection d'un exercice du niveau superieur si le patient est au niveau modere ou severe
        if($indice == 3 || $indice == 2)
        {
            $niveau_sup = $this->Crud->get_data('niveau',['indice'=>$indice-1])[0];
            
            //===On verifie si il y a des exercice au niveau sup===
            if(count($this->exercice->exercice_not_done($niveau_sup->id)) > 0)
            {
                $index = random_int(0,count($this->exercice->exercice_not_done($niveau_sup->id))-1);
                $recommandation = $this->exercice->exercice_not_done($niveau_sup->id)[$index];                
            }             
            else{
                //s'il n'ya pas
                $recommandation = $this->rc_same_level($niveau);
            }
        }
        else if($indice == 1)
        {
            $nb_exercice = count($this->exercice->nb_exercice_done($niveau->id));

            //===s'il y a au moins deux exercices fait a c niveau on passe au mme===
            if($nb_exercice >= 2)
            {
                $recommandation = $this->Crud->get_data('exercice',['type'=>'mmse'])[0];
            }else{
                $recommandation = $this->rc_same_level($niveau);
            }                
        }
        return $recommandation;
    }

    //recommandation exercice du meme niveau
    public function rc_same_level($niveau)
    {
        $recommandation = null;
        //===selection d'un exercice du meme niveau si il y a fait 1 seul exerc===
        if(count($this->exercice->exercice_not_done($niveau->id)) > 0)
        {
            $index = random_int(0,count($this->exercice->exercice_not_done($niveau->id))-1);
            $recommandation = $this->exercice->exercice_not_done($niveau->id)[$index];
        }

        return $recommandation;
    }
     //supprmer un exercice recommandé
   public function delete_recommanded_exercice($exercice_id)
   {
        $this->Crud->delete_data('recommandation',['exercice_id'=>$exercice_id,'utilisateur_id'=>$this->session->id]);
   }
}