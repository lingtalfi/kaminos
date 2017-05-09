<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;
use FormModel\Control\TextAreaControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class Csv_fournisseurs_comparatifPersistentRowCollection extends QuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.csv_fournisseurs_comparatif");
        $this->fields = '
csv_fournisseurs_comparatif.id,
csv_fournisseurs_comparatif.ref_hldp,
csv_fournisseurs_comparatif.ref_lf,
csv_fournisseurs_comparatif.produit,
csv_fournisseurs_comparatif.m3,
csv_fournisseurs_comparatif.gw,
csv_fournisseurs_comparatif.nw,
csv_fournisseurs_comparatif.vendu_par,
csv_fournisseurs_comparatif.ean,
csv_fournisseurs_comparatif.nom_hldp,
csv_fournisseurs_comparatif.nom_leaderfit,
csv_fournisseurs_comparatif.poids,
csv_fournisseurs_comparatif.materiaux,
csv_fournisseurs_comparatif.etat_import,
csv_fournisseurs_comparatif.largeur,
csv_fournisseurs_comparatif.hauteur,
csv_fournisseurs_comparatif.longueur,
csv_fournisseurs_comparatif.resistance,
csv_fournisseurs_comparatif.autres,
csv_fournisseurs_comparatif.MOQ,
csv_fournisseurs_comparatif.packaging,
csv_fournisseurs_comparatif.categorie,
csv_fournisseurs_comparatif.descriptif,
csv_fournisseurs_comparatif.url,
csv_fournisseurs_comparatif.en_products,
csv_fournisseurs_comparatif.en_sold_by,
csv_fournisseurs_comparatif.en_packaging,
csv_fournisseurs_comparatif.en_material,
csv_fournisseurs_comparatif.en_description,
csv_fournisseurs_comparatif.en_category,
csv_fournisseurs_comparatif.es_products,
csv_fournisseurs_comparatif.es_sold_by,
csv_fournisseurs_comparatif.es_packaging,
csv_fournisseurs_comparatif.es_material,
csv_fournisseurs_comparatif.es_category,
csv_fournisseurs_comparatif.moyenne,
csv_fournisseurs_comparatif.wohlstand,
csv_fournisseurs_comparatif.rising,
csv_fournisseurs_comparatif.top_asia,
csv_fournisseurs_comparatif.azuni,
csv_fournisseurs_comparatif.kylin,
csv_fournisseurs_comparatif.modern_sports,
csv_fournisseurs_comparatif.gyco,
csv_fournisseurs_comparatif.lion,
csv_fournisseurs_comparatif.live_up,
csv_fournisseurs_comparatif.ironmaster,
csv_fournisseurs_comparatif.record,
csv_fournisseurs_comparatif.tengtai,
csv_fournisseurs_comparatif.dekai,
csv_fournisseurs_comparatif.alex,
csv_fournisseurs_comparatif.regal,
csv_fournisseurs_comparatif.helisports,
csv_fournisseurs_comparatif.amaya,
csv_fournisseurs_comparatif.msd,
csv_fournisseurs_comparatif.fournisseur,
csv_fournisseurs_comparatif.unit,
csv_fournisseurs_comparatif.pa_dollar,
csv_fournisseurs_comparatif.pa_fdp_inclus,
csv_fournisseurs_comparatif.ob_marge_hldp,
csv_fournisseurs_comparatif.ob_pv_fob_dollar,
csv_fournisseurs_comparatif.ob_pv_fob,
csv_fournisseurs_comparatif.ob_pv_hldp_dollar,
csv_fournisseurs_comparatif.ob_pv_hldp,
csv_fournisseurs_comparatif.pv_lf_orange,
csv_fournisseurs_comparatif.reduction,
csv_fournisseurs_comparatif.produit_specifique,
csv_fournisseurs_comparatif.rev_marge_hldp,
csv_fournisseurs_comparatif.rev_pv_fob_dollar,
csv_fournisseurs_comparatif.rev_pv_fob,
csv_fournisseurs_comparatif.rev_pv_hldp_dollar,
csv_fournisseurs_comparatif.rev_pv_hldp,
csv_fournisseurs_comparatif.gev_marge_hldp,
csv_fournisseurs_comparatif.gev_pv_fob_dollar,
csv_fournisseurs_comparatif.gev_pv_fob,
csv_fournisseurs_comparatif.gev_pv_hldp_dollar,
csv_fournisseurs_comparatif.gev_pv_hldp,
csv_fournisseurs_comparatif.gev_pv_hldp2,
csv_fournisseurs_comparatif.gev_pv_hldp3,
csv_fournisseurs_comparatif.cha_marge_hldp,
csv_fournisseurs_comparatif.cha_pv_fob_dollar,
csv_fournisseurs_comparatif.cha_pv_fob,
csv_fournisseurs_comparatif.cha_pv_hldp_dollar,
csv_fournisseurs_comparatif.cha_pv_hldp,
csv_fournisseurs_comparatif.cha_pv_hldp2,
csv_fournisseurs_comparatif.kin_marge_hldp,
csv_fournisseurs_comparatif.kin_pv_fob_dollar,
csv_fournisseurs_comparatif.kin_pv_fob,
csv_fournisseurs_comparatif.kin_pv_hldp_dollar,
csv_fournisseurs_comparatif.kin_pv_hldp,
csv_fournisseurs_comparatif.kin_pv_hldp2,
csv_fournisseurs_comparatif.fit_marge_hldp,
csv_fournisseurs_comparatif.fit_pv_fob_dollar,
csv_fournisseurs_comparatif.fit_pv_fob,
csv_fournisseurs_comparatif.fit_pv_hldp_dollar,
csv_fournisseurs_comparatif.fit_pv_hldp,
csv_fournisseurs_comparatif.fit_pv_hldp2,
csv_fournisseurs_comparatif.lf_pv_public,
csv_fournisseurs_comparatif.lf_pv_public_dollar,
csv_fournisseurs_comparatif.lf_reduction,
csv_fournisseurs_comparatif.lf_pv_revendeur,
csv_fournisseurs_comparatif.lf_pv_revendeur_dollar
';
        $this->query = '
SELECT
%s
FROM zilu.csv_fournisseurs_comparatif
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
        $validator
			->setTests("ref_hldp", "ref_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("ref_lf", "ref_lf", [
                RequiredControlTest::create(),
            ])
			->setTests("m3", "m3", [
                RequiredControlTest::create(),
            ])
			->setTests("gw", "gw", [
                RequiredControlTest::create(),
            ])
			->setTests("nw", "nw", [
                RequiredControlTest::create(),
            ])
			->setTests("vendu_par", "vendu_par", [
                RequiredControlTest::create(),
            ])
			->setTests("ean", "ean", [
                RequiredControlTest::create(),
            ])
			->setTests("poids", "poids", [
                RequiredControlTest::create(),
            ])
			->setTests("materiaux", "materiaux", [
                RequiredControlTest::create(),
            ])
			->setTests("etat_import", "etat_import", [
                RequiredControlTest::create(),
            ])
			->setTests("largeur", "largeur", [
                RequiredControlTest::create(),
            ])
			->setTests("hauteur", "hauteur", [
                RequiredControlTest::create(),
            ])
			->setTests("longueur", "longueur", [
                RequiredControlTest::create(),
            ])
			->setTests("resistance", "resistance", [
                RequiredControlTest::create(),
            ])
			->setTests("autres", "autres", [
                RequiredControlTest::create(),
            ])
			->setTests("MOQ", "MOQ", [
                RequiredControlTest::create(),
            ])
			->setTests("packaging", "packaging", [
                RequiredControlTest::create(),
            ])
			->setTests("categorie", "categorie", [
                RequiredControlTest::create(),
            ])
			->setTests("url", "url", [
                RequiredControlTest::create(),
            ])
			->setTests("en_products", "en_products", [
                RequiredControlTest::create(),
            ])
			->setTests("en_sold_by", "en_sold_by", [
                RequiredControlTest::create(),
            ])
			->setTests("en_packaging", "en_packaging", [
                RequiredControlTest::create(),
            ])
			->setTests("en_material", "en_material", [
                RequiredControlTest::create(),
            ])
			->setTests("en_category", "en_category", [
                RequiredControlTest::create(),
            ])
			->setTests("es_sold_by", "es_sold_by", [
                RequiredControlTest::create(),
            ])
			->setTests("es_packaging", "es_packaging", [
                RequiredControlTest::create(),
            ])
			->setTests("es_material", "es_material", [
                RequiredControlTest::create(),
            ])
			->setTests("es_category", "es_category", [
                RequiredControlTest::create(),
            ])
			->setTests("moyenne", "moyenne", [
                RequiredControlTest::create(),
            ])
			->setTests("wohlstand", "wohlstand", [
                RequiredControlTest::create(),
            ])
			->setTests("rising", "rising", [
                RequiredControlTest::create(),
            ])
			->setTests("top_asia", "top_asia", [
                RequiredControlTest::create(),
            ])
			->setTests("azuni", "azuni", [
                RequiredControlTest::create(),
            ])
			->setTests("kylin", "kylin", [
                RequiredControlTest::create(),
            ])
			->setTests("modern_sports", "modern_sports", [
                RequiredControlTest::create(),
            ])
			->setTests("gyco", "gyco", [
                RequiredControlTest::create(),
            ])
			->setTests("lion", "lion", [
                RequiredControlTest::create(),
            ])
			->setTests("live_up", "live_up", [
                RequiredControlTest::create(),
            ])
			->setTests("ironmaster", "ironmaster", [
                RequiredControlTest::create(),
            ])
			->setTests("record", "record", [
                RequiredControlTest::create(),
            ])
			->setTests("tengtai", "tengtai", [
                RequiredControlTest::create(),
            ])
			->setTests("dekai", "dekai", [
                RequiredControlTest::create(),
            ])
			->setTests("alex", "alex", [
                RequiredControlTest::create(),
            ])
			->setTests("regal", "regal", [
                RequiredControlTest::create(),
            ])
			->setTests("helisports", "helisports", [
                RequiredControlTest::create(),
            ])
			->setTests("amaya", "amaya", [
                RequiredControlTest::create(),
            ])
			->setTests("msd", "msd", [
                RequiredControlTest::create(),
            ])
			->setTests("fournisseur", "fournisseur", [
                RequiredControlTest::create(),
            ])
			->setTests("unit", "unit", [
                RequiredControlTest::create(),
            ])
			->setTests("pa_dollar", "pa_dollar", [
                RequiredControlTest::create(),
            ])
			->setTests("pa_fdp_inclus", "pa_fdp_inclus", [
                RequiredControlTest::create(),
            ])
			->setTests("ob_marge_hldp", "ob_marge_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("ob_pv_fob_dollar", "ob_pv_fob_dollar", [
                RequiredControlTest::create(),
            ])
			->setTests("ob_pv_fob", "ob_pv_fob", [
                RequiredControlTest::create(),
            ])
			->setTests("ob_pv_hldp_dollar", "ob_pv_hldp_dollar", [
                RequiredControlTest::create(),
            ])
			->setTests("ob_pv_hldp", "ob_pv_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("pv_lf_orange", "pv_lf_orange", [
                RequiredControlTest::create(),
            ])
			->setTests("reduction", "reduction", [
                RequiredControlTest::create(),
            ])
			->setTests("produit_specifique", "produit_specifique", [
                RequiredControlTest::create(),
            ])
			->setTests("rev_marge_hldp", "rev_marge_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("rev_pv_fob_dollar", "rev_pv_fob_dollar", [
                RequiredControlTest::create(),
            ])
			->setTests("rev_pv_fob", "rev_pv_fob", [
                RequiredControlTest::create(),
            ])
			->setTests("rev_pv_hldp_dollar", "rev_pv_hldp_dollar", [
                RequiredControlTest::create(),
            ])
			->setTests("rev_pv_hldp", "rev_pv_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("gev_marge_hldp", "gev_marge_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("gev_pv_fob_dollar", "gev_pv_fob_dollar", [
                RequiredControlTest::create(),
            ])
			->setTests("gev_pv_fob", "gev_pv_fob", [
                RequiredControlTest::create(),
            ])
			->setTests("gev_pv_hldp_dollar", "gev_pv_hldp_dollar", [
                RequiredControlTest::create(),
            ])
			->setTests("gev_pv_hldp", "gev_pv_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("gev_pv_hldp2", "gev_pv_hldp2", [
                RequiredControlTest::create(),
            ])
			->setTests("gev_pv_hldp3", "gev_pv_hldp3", [
                RequiredControlTest::create(),
            ])
			->setTests("cha_marge_hldp", "cha_marge_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("cha_pv_fob_dollar", "cha_pv_fob_dollar", [
                RequiredControlTest::create(),
            ])
			->setTests("cha_pv_fob", "cha_pv_fob", [
                RequiredControlTest::create(),
            ])
			->setTests("cha_pv_hldp_dollar", "cha_pv_hldp_dollar", [
                RequiredControlTest::create(),
            ])
			->setTests("cha_pv_hldp", "cha_pv_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("cha_pv_hldp2", "cha_pv_hldp2", [
                RequiredControlTest::create(),
            ])
			->setTests("kin_marge_hldp", "kin_marge_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("kin_pv_fob_dollar", "kin_pv_fob_dollar", [
                RequiredControlTest::create(),
            ])
			->setTests("kin_pv_fob", "kin_pv_fob", [
                RequiredControlTest::create(),
            ])
			->setTests("kin_pv_hldp_dollar", "kin_pv_hldp_dollar", [
                RequiredControlTest::create(),
            ])
			->setTests("kin_pv_hldp", "kin_pv_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("kin_pv_hldp2", "kin_pv_hldp2", [
                RequiredControlTest::create(),
            ])
			->setTests("fit_marge_hldp", "fit_marge_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("fit_pv_fob_dollar", "fit_pv_fob_dollar", [
                RequiredControlTest::create(),
            ])
			->setTests("fit_pv_fob", "fit_pv_fob", [
                RequiredControlTest::create(),
            ])
			->setTests("fit_pv_hldp_dollar", "fit_pv_hldp_dollar", [
                RequiredControlTest::create(),
            ])
			->setTests("fit_pv_hldp", "fit_pv_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("fit_pv_hldp2", "fit_pv_hldp2", [
                RequiredControlTest::create(),
            ])
			->setTests("lf_pv_public", "lf_pv_public", [
                RequiredControlTest::create(),
            ])
			->setTests("lf_pv_public_dollar", "lf_pv_public_dollar", [
                RequiredControlTest::create(),
            ])
			->setTests("lf_reduction", "lf_reduction", [
                RequiredControlTest::create(),
            ])
			->setTests("lf_pv_revendeur", "lf_pv_revendeur", [
                RequiredControlTest::create(),
            ])
			->setTests("lf_pv_revendeur_dollar", "lf_pv_revendeur_dollar", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("ref_hldp", InputTextControl::create()
                ->label("ref_hldp")
                ->name("ref_hldp")
            )
            ->addControl("ref_lf", InputTextControl::create()
                ->label("ref_lf")
                ->name("ref_lf")
            )
            ->addControl("produit", TextAreaControl::create()
                ->label("produit")
                ->name("produit")
            )
            ->addControl("m3", InputTextControl::create()
                ->label("m3")
                ->name("m3")
            )
            ->addControl("gw", InputTextControl::create()
                ->label("gw")
                ->name("gw")
            )
            ->addControl("nw", InputTextControl::create()
                ->label("nw")
                ->name("nw")
            )
            ->addControl("vendu_par", InputTextControl::create()
                ->label("vendu_par")
                ->name("vendu_par")
            )
            ->addControl("ean", InputTextControl::create()
                ->label("ean")
                ->name("ean")
            )
            ->addControl("nom_hldp", TextAreaControl::create()
                ->label("nom_hldp")
                ->name("nom_hldp")
            )
            ->addControl("nom_leaderfit", TextAreaControl::create()
                ->label("nom_leaderfit")
                ->name("nom_leaderfit")
            )
            ->addControl("poids", InputTextControl::create()
                ->label("poids")
                ->name("poids")
            )
            ->addControl("materiaux", InputTextControl::create()
                ->label("materiaux")
                ->name("materiaux")
            )
            ->addControl("etat_import", InputTextControl::create()
                ->label("etat_import")
                ->name("etat_import")
            )
            ->addControl("largeur", InputTextControl::create()
                ->label("largeur")
                ->name("largeur")
            )
            ->addControl("hauteur", InputTextControl::create()
                ->label("hauteur")
                ->name("hauteur")
            )
            ->addControl("longueur", InputTextControl::create()
                ->label("longueur")
                ->name("longueur")
            )
            ->addControl("resistance", InputTextControl::create()
                ->label("resistance")
                ->name("resistance")
            )
            ->addControl("autres", InputTextControl::create()
                ->label("autres")
                ->name("autres")
            )
            ->addControl("MOQ", InputTextControl::create()
                ->label("MOQ")
                ->name("MOQ")
            )
            ->addControl("packaging", InputTextControl::create()
                ->label("packaging")
                ->name("packaging")
            )
            ->addControl("categorie", InputTextControl::create()
                ->label("categorie")
                ->name("categorie")
            )
            ->addControl("descriptif", TextAreaControl::create()
                ->label("descriptif")
                ->name("descriptif")
            )
            ->addControl("url", InputTextControl::create()
                ->label("url")
                ->name("url")
            )
            ->addControl("en_products", InputTextControl::create()
                ->label("en_products")
                ->name("en_products")
            )
            ->addControl("en_sold_by", InputTextControl::create()
                ->label("en_sold_by")
                ->name("en_sold_by")
            )
            ->addControl("en_packaging", InputTextControl::create()
                ->label("en_packaging")
                ->name("en_packaging")
            )
            ->addControl("en_material", InputTextControl::create()
                ->label("en_material")
                ->name("en_material")
            )
            ->addControl("en_description", TextAreaControl::create()
                ->label("en_description")
                ->name("en_description")
            )
            ->addControl("en_category", InputTextControl::create()
                ->label("en_category")
                ->name("en_category")
            )
            ->addControl("es_products", TextAreaControl::create()
                ->label("es_products")
                ->name("es_products")
            )
            ->addControl("es_sold_by", InputTextControl::create()
                ->label("es_sold_by")
                ->name("es_sold_by")
            )
            ->addControl("es_packaging", InputTextControl::create()
                ->label("es_packaging")
                ->name("es_packaging")
            )
            ->addControl("es_material", InputTextControl::create()
                ->label("es_material")
                ->name("es_material")
            )
            ->addControl("es_category", InputTextControl::create()
                ->label("es_category")
                ->name("es_category")
            )
            ->addControl("moyenne", InputTextControl::create()
                ->label("moyenne")
                ->name("moyenne")
            )
            ->addControl("wohlstand", InputTextControl::create()
                ->label("wohlstand")
                ->name("wohlstand")
            )
            ->addControl("rising", InputTextControl::create()
                ->label("rising")
                ->name("rising")
            )
            ->addControl("top_asia", InputTextControl::create()
                ->label("top_asia")
                ->name("top_asia")
            )
            ->addControl("azuni", InputTextControl::create()
                ->label("azuni")
                ->name("azuni")
            )
            ->addControl("kylin", InputTextControl::create()
                ->label("kylin")
                ->name("kylin")
            )
            ->addControl("modern_sports", InputTextControl::create()
                ->label("modern_sports")
                ->name("modern_sports")
            )
            ->addControl("gyco", InputTextControl::create()
                ->label("gyco")
                ->name("gyco")
            )
            ->addControl("lion", InputTextControl::create()
                ->label("lion")
                ->name("lion")
            )
            ->addControl("live_up", InputTextControl::create()
                ->label("live_up")
                ->name("live_up")
            )
            ->addControl("ironmaster", InputTextControl::create()
                ->label("ironmaster")
                ->name("ironmaster")
            )
            ->addControl("record", InputTextControl::create()
                ->label("record")
                ->name("record")
            )
            ->addControl("tengtai", InputTextControl::create()
                ->label("tengtai")
                ->name("tengtai")
            )
            ->addControl("dekai", InputTextControl::create()
                ->label("dekai")
                ->name("dekai")
            )
            ->addControl("alex", InputTextControl::create()
                ->label("alex")
                ->name("alex")
            )
            ->addControl("regal", InputTextControl::create()
                ->label("regal")
                ->name("regal")
            )
            ->addControl("helisports", InputTextControl::create()
                ->label("helisports")
                ->name("helisports")
            )
            ->addControl("amaya", InputTextControl::create()
                ->label("amaya")
                ->name("amaya")
            )
            ->addControl("msd", InputTextControl::create()
                ->label("msd")
                ->name("msd")
            )
            ->addControl("fournisseur", InputTextControl::create()
                ->label("fournisseur")
                ->name("fournisseur")
            )
            ->addControl("unit", InputTextControl::create()
                ->label("unit")
                ->name("unit")
            )
            ->addControl("pa_dollar", InputTextControl::create()
                ->label("pa_dollar")
                ->name("pa_dollar")
            )
            ->addControl("pa_fdp_inclus", InputTextControl::create()
                ->label("pa_fdp_inclus")
                ->name("pa_fdp_inclus")
            )
            ->addControl("ob_marge_hldp", InputTextControl::create()
                ->label("ob_marge_hldp")
                ->name("ob_marge_hldp")
            )
            ->addControl("ob_pv_fob_dollar", InputTextControl::create()
                ->label("ob_pv_fob_dollar")
                ->name("ob_pv_fob_dollar")
            )
            ->addControl("ob_pv_fob", InputTextControl::create()
                ->label("ob_pv_fob")
                ->name("ob_pv_fob")
            )
            ->addControl("ob_pv_hldp_dollar", InputTextControl::create()
                ->label("ob_pv_hldp_dollar")
                ->name("ob_pv_hldp_dollar")
            )
            ->addControl("ob_pv_hldp", InputTextControl::create()
                ->label("ob_pv_hldp")
                ->name("ob_pv_hldp")
            )
            ->addControl("pv_lf_orange", InputTextControl::create()
                ->label("pv_lf_orange")
                ->name("pv_lf_orange")
            )
            ->addControl("reduction", InputTextControl::create()
                ->label("reduction")
                ->name("reduction")
            )
            ->addControl("produit_specifique", InputTextControl::create()
                ->label("produit_specifique")
                ->name("produit_specifique")
            )
            ->addControl("rev_marge_hldp", InputTextControl::create()
                ->label("rev_marge_hldp")
                ->name("rev_marge_hldp")
            )
            ->addControl("rev_pv_fob_dollar", InputTextControl::create()
                ->label("rev_pv_fob_dollar")
                ->name("rev_pv_fob_dollar")
            )
            ->addControl("rev_pv_fob", InputTextControl::create()
                ->label("rev_pv_fob")
                ->name("rev_pv_fob")
            )
            ->addControl("rev_pv_hldp_dollar", InputTextControl::create()
                ->label("rev_pv_hldp_dollar")
                ->name("rev_pv_hldp_dollar")
            )
            ->addControl("rev_pv_hldp", InputTextControl::create()
                ->label("rev_pv_hldp")
                ->name("rev_pv_hldp")
            )
            ->addControl("gev_marge_hldp", InputTextControl::create()
                ->label("gev_marge_hldp")
                ->name("gev_marge_hldp")
            )
            ->addControl("gev_pv_fob_dollar", InputTextControl::create()
                ->label("gev_pv_fob_dollar")
                ->name("gev_pv_fob_dollar")
            )
            ->addControl("gev_pv_fob", InputTextControl::create()
                ->label("gev_pv_fob")
                ->name("gev_pv_fob")
            )
            ->addControl("gev_pv_hldp_dollar", InputTextControl::create()
                ->label("gev_pv_hldp_dollar")
                ->name("gev_pv_hldp_dollar")
            )
            ->addControl("gev_pv_hldp", InputTextControl::create()
                ->label("gev_pv_hldp")
                ->name("gev_pv_hldp")
            )
            ->addControl("gev_pv_hldp2", InputTextControl::create()
                ->label("gev_pv_hldp2")
                ->name("gev_pv_hldp2")
            )
            ->addControl("gev_pv_hldp3", InputTextControl::create()
                ->label("gev_pv_hldp3")
                ->name("gev_pv_hldp3")
            )
            ->addControl("cha_marge_hldp", InputTextControl::create()
                ->label("cha_marge_hldp")
                ->name("cha_marge_hldp")
            )
            ->addControl("cha_pv_fob_dollar", InputTextControl::create()
                ->label("cha_pv_fob_dollar")
                ->name("cha_pv_fob_dollar")
            )
            ->addControl("cha_pv_fob", InputTextControl::create()
                ->label("cha_pv_fob")
                ->name("cha_pv_fob")
            )
            ->addControl("cha_pv_hldp_dollar", InputTextControl::create()
                ->label("cha_pv_hldp_dollar")
                ->name("cha_pv_hldp_dollar")
            )
            ->addControl("cha_pv_hldp", InputTextControl::create()
                ->label("cha_pv_hldp")
                ->name("cha_pv_hldp")
            )
            ->addControl("cha_pv_hldp2", InputTextControl::create()
                ->label("cha_pv_hldp2")
                ->name("cha_pv_hldp2")
            )
            ->addControl("kin_marge_hldp", InputTextControl::create()
                ->label("kin_marge_hldp")
                ->name("kin_marge_hldp")
            )
            ->addControl("kin_pv_fob_dollar", InputTextControl::create()
                ->label("kin_pv_fob_dollar")
                ->name("kin_pv_fob_dollar")
            )
            ->addControl("kin_pv_fob", InputTextControl::create()
                ->label("kin_pv_fob")
                ->name("kin_pv_fob")
            )
            ->addControl("kin_pv_hldp_dollar", InputTextControl::create()
                ->label("kin_pv_hldp_dollar")
                ->name("kin_pv_hldp_dollar")
            )
            ->addControl("kin_pv_hldp", InputTextControl::create()
                ->label("kin_pv_hldp")
                ->name("kin_pv_hldp")
            )
            ->addControl("kin_pv_hldp2", InputTextControl::create()
                ->label("kin_pv_hldp2")
                ->name("kin_pv_hldp2")
            )
            ->addControl("fit_marge_hldp", InputTextControl::create()
                ->label("fit_marge_hldp")
                ->name("fit_marge_hldp")
            )
            ->addControl("fit_pv_fob_dollar", InputTextControl::create()
                ->label("fit_pv_fob_dollar")
                ->name("fit_pv_fob_dollar")
            )
            ->addControl("fit_pv_fob", InputTextControl::create()
                ->label("fit_pv_fob")
                ->name("fit_pv_fob")
            )
            ->addControl("fit_pv_hldp_dollar", InputTextControl::create()
                ->label("fit_pv_hldp_dollar")
                ->name("fit_pv_hldp_dollar")
            )
            ->addControl("fit_pv_hldp", InputTextControl::create()
                ->label("fit_pv_hldp")
                ->name("fit_pv_hldp")
            )
            ->addControl("fit_pv_hldp2", InputTextControl::create()
                ->label("fit_pv_hldp2")
                ->name("fit_pv_hldp2")
            )
            ->addControl("lf_pv_public", InputTextControl::create()
                ->label("lf_pv_public")
                ->name("lf_pv_public")
            )
            ->addControl("lf_pv_public_dollar", InputTextControl::create()
                ->label("lf_pv_public_dollar")
                ->name("lf_pv_public_dollar")
            )
            ->addControl("lf_reduction", InputTextControl::create()
                ->label("lf_reduction")
                ->name("lf_reduction")
            )
            ->addControl("lf_pv_revendeur", InputTextControl::create()
                ->label("lf_pv_revendeur")
                ->name("lf_pv_revendeur")
            )
            ->addControl("lf_pv_revendeur_dollar", InputTextControl::create()
                ->label("lf_pv_revendeur_dollar")
                ->name("lf_pv_revendeur_dollar")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}