<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Control\InputTextControl;
use FormModel\Control\TextAreaControl;
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
            ->addControl("reference", InputTextControl::create()
                ->label("reference")
                ->name("reference")
            )
            ->addControl("reference_fournisseur", InputTextControl::create()
                ->label("reference_fournisseur")
                ->name("reference_fournisseur")
            )
            ->addControl("fournisseur", InputTextControl::create()
                ->label("fournisseur")
                ->name("fournisseur")
            )
            ->addControl("produits", InputTextControl::create()
                ->label("produits")
                ->name("produits")
            )
            ->addControl("libelle_origine", InputTextControl::create()
                ->label("libelle_origine")
                ->name("libelle_origine")
            )
            ->addControl("unit", InputTextControl::create()
                ->label("unit")
                ->name("unit")
            )
            ->addControl("pmp_achat_dollar", InputTextControl::create()
                ->label("pmp_achat_dollar")
                ->name("pmp_achat_dollar")
            )
            ->addControl("pmp_achat_euro", InputTextControl::create()
                ->label("pmp_achat_euro")
                ->name("pmp_achat_euro")
            )
            ->addControl("port", InputTextControl::create()
                ->label("port")
                ->name("port")
            )
            ->addControl("paht_frais", InputTextControl::create()
                ->label("paht_frais")
                ->name("paht_frais")
            )
            ->addControl("pv_public_ht", InputTextControl::create()
                ->label("pv_public_ht")
                ->name("pv_public_ht")
            )
            ->addControl("marge_prix_public", InputTextControl::create()
                ->label("marge_prix_public")
                ->name("marge_prix_public")
            )
            ->addControl("pv_public_ttc", InputTextControl::create()
                ->label("pv_public_ttc")
                ->name("pv_public_ttc")
            )
            ->addControl("prix_pro", InputTextControl::create()
                ->label("prix_pro")
                ->name("prix_pro")
            )
            ->addControl("remise_club", InputTextControl::create()
                ->label("remise_club")
                ->name("remise_club")
            )
            ->addControl("marge_prix_club", InputTextControl::create()
                ->label("marge_prix_club")
                ->name("marge_prix_club")
            )
            ->addControl("prix_franchise", InputTextControl::create()
                ->label("prix_franchise")
                ->name("prix_franchise")
            )
            ->addControl("remise_franchise", InputTextControl::create()
                ->label("remise_franchise")
                ->name("remise_franchise")
            )
            ->addControl("marge_franchise", InputTextControl::create()
                ->label("marge_franchise")
                ->name("marge_franchise")
            )
            ->addControl("poids_net", InputTextControl::create()
                ->label("poids_net")
                ->name("poids_net")
            )
            ->addControl("poids", InputTextControl::create()
                ->label("poids")
                ->name("poids")
            )
            ->addControl("famille_produit", InputTextControl::create()
                ->label("famille_produit")
                ->name("famille_produit")
            )
            ->addControl("dimensions", InputTextControl::create()
                ->label("dimensions")
                ->name("dimensions")
            )
            ->addControl("code_compta", InputTextControl::create()
                ->label("code_compta")
                ->name("code_compta")
            )
            ->addControl("description", TextAreaControl::create()
                ->label("description")
                ->name("description")
            )
            ->addControl("photos", DropZoneControl::create()
                ->setShowDeleteLink(true)
                ->setProfileId("AutoAdmin/zilu.csv_prix_materiel.photos")            
                ->label("photos")
                ->name("photos")
            )
            ->addControl("tva", InputTextControl::create()
                ->label("tva")
                ->name("tva")
            )
            ->addControl("code_ean", InputTextControl::create()
                ->label("code_ean")
                ->name("code_ean")
            )
            ->addControl("date_arrivee", InputTextControl::create()
                ->label("date_arrivee")
                ->name("date_arrivee")
            )
            ->addControl("m3", InputTextControl::create()
                ->label("m3")
                ->name("m3")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}