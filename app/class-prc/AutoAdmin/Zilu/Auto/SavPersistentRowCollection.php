<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Control\InputTextControl;
use Module\NullosAdmin\FormModel\Control\DatetimePickerInputTextControl;
use FormModel\Control\TextAreaControl;
use Module\NullosAdmin\FormModel\Control\DropZoneControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class SavPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.sav");
        $this->fields = '
sav.id,
sav.fournisseur,
sav.reference_lf,
sav.produit,
sav.livre_le,
sav.quantite,
sav.prix,
sav.nb_produits_defec,
sav.date_notif,
sav.demande_remboursement,
sav.montant_rembourse,
sav.pourcentage_rembourse,
sav.date_remboursement,
sav.forme,
sav.statut,
sav.photo,
sav.avancement
';
        $this->query = '
SELECT
%s
FROM zilu.sav
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
            ->addControl("fournisseur", InputTextControl::create()
                ->label("fournisseur")
                ->name("fournisseur")
            )
            ->addControl("reference_lf", InputTextControl::create()
                ->label("reference_lf")
                ->name("reference_lf")
            )
            ->addControl("produit", InputTextControl::create()
                ->label("produit")
                ->name("produit")
            )
            ->addControl("livre_le", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => false])
                ->label("livre_le")
                ->name("livre_le")
            )
            ->addControl("quantite", InputTextControl::create()
                ->label("quantite")
                ->name("quantite")
            )
            ->addControl("prix", InputTextControl::create()
                ->label("prix")
                ->name("prix")
            )
            ->addControl("nb_produits_defec", InputTextControl::create()
                ->label("nb_produits_defec")
                ->name("nb_produits_defec")
            )
            ->addControl("date_notif", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => false])
                ->label("date_notif")
                ->name("date_notif")
            )
            ->addControl("demande_remboursement", InputTextControl::create()
                ->label("demande_remboursement")
                ->name("demande_remboursement")
            )
            ->addControl("montant_rembourse", InputTextControl::create()
                ->label("montant_rembourse")
                ->name("montant_rembourse")
            )
            ->addControl("pourcentage_rembourse", InputTextControl::create()
                ->label("pourcentage_rembourse")
                ->name("pourcentage_rembourse")
            )
            ->addControl("date_remboursement", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => false])
                ->label("date_remboursement")
                ->name("date_remboursement")
            )
            ->addControl("forme", InputTextControl::create()
                ->label("forme")
                ->name("forme")
            )
            ->addControl("statut", TextAreaControl::create()
                ->label("statut")
                ->name("statut")
            )
            ->addControl("photo", DropZoneControl::create()
                ->setShowDeleteLink(true)
                ->setProfileId("AutoAdmin/zilu.sav.photo")            
                ->label("photo")
                ->name("photo")
            )
            ->addControl("avancement", InputTextControl::create()
                ->label("avancement")
                ->name("avancement")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}