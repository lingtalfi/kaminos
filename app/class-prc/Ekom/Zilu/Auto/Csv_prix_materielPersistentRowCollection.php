<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use Module\NullosAdmin\FormModel\Control\DropZoneControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Csv_prix_materielPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.csv_prix_materiel");
        $this->fields = '
csv_prix_materiel.id,
csv_prix_materiel.reference,
csv_prix_materiel.reference_fournisseur,
csv_prix_materiel.fournisseur,
csv_prix_materiel.produits,
csv_prix_materiel.libelle_origine,
csv_prix_materiel.unit,
csv_prix_materiel.pmp_achat_dollar,
csv_prix_materiel.pmp_achat_euro,
csv_prix_materiel.port,
csv_prix_materiel.paht_frais,
csv_prix_materiel.pv_public_ht,
csv_prix_materiel.marge_prix_public,
csv_prix_materiel.pv_public_ttc,
csv_prix_materiel.prix_pro,
csv_prix_materiel.remise_club,
csv_prix_materiel.marge_prix_club,
csv_prix_materiel.prix_franchise,
csv_prix_materiel.remise_franchise,
csv_prix_materiel.marge_franchise,
csv_prix_materiel.poids_net,
csv_prix_materiel.poids,
csv_prix_materiel.famille_produit,
csv_prix_materiel.dimensions,
csv_prix_materiel.code_compta,
csv_prix_materiel.description,
csv_prix_materiel.photos,
csv_prix_materiel.tva,
csv_prix_materiel.code_ean,
csv_prix_materiel.date_arrivee,
csv_prix_materiel.m3
';
        $this->query = '
SELECT
%s
FROM zilu.csv_prix_materiel
';
    }


    public function getRic()
    {
        return [
    'id',
];
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function decorateFormModelValidator(ControlsValidator $validator)
    {
        
    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("photos", DropZoneControl::create()
                ->setShowDeleteLink(true)
                ->setProfileId("Ekom/zilu.csv_prix_materiel.photos")            
                ->label("photos")
                ->name("photos")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}