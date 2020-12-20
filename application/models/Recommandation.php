<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recommandation extends CI_Model
{
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
}