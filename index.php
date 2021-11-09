<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Академия Информационных Систем (АИС) проводит обучение специалистов по ИТ, ИБ, безопасности бизнеса, конкурентной разведке и независимую оценку квалификации.");
$APPLICATION->SetPageProperty("title", "Обучение специалистов в Академии Информационных Систем");
$APPLICATION->SetTitle("Повышение квалификации и переподготовка специалистов");
if(!empty($_GET['id'])){
    $redirect=[
        '5149'=>'/courses/mezhdunarod/podgotovka_vedushchego_auditora_sistem_upravleniya_informatsionnoy_bezopasnostyu_po_m_n_standartu_bs/?sphrase_id=77',
        '493'=>'/courses/mezhdunarod/vvedenie_v_sistemy_upravleniya_informatsionnoy_bezopasnostyu_i_iso_iec_27001_2013/?sphrase_id=67',
        '492'=>'/courses/mezhdunarod/vnedrenie_sistemy_upravleniya_informatsionnoy_bezopasnostyu_dlya_sootvetstviya_trebovaniyam_m_n_stan/?sphrase_id=68',
        '506'=>'/courses/mezhdunarod/vnutrenniy_audit_sistemy_upravleniya_informatsionnoy_bezopasnostyu_na_sootvetstvie_trebovaniyam_iso_/?sphrase_id=71',
        '5956'=>'/courses/ekonomicheskaya/upravlenie_elektronnymi_dokumentami_yuridicheskaya_znachimost_i_sudebnaya_praktika/?sphrase_id=163',
        '6981'=>'/courses/ekonomicheskaya/priem_i_uvolnenie_personala_s_pozitsii_bezopasnosti/?sphrase_id=160',
        '6809'=>'/courses/ekonomicheskaya/kompleksnyy_kurs_po_proverke_kontragentov/?sphrase_id=155',
        '6983'=>'/courses/ekonomicheskaya/kadrovaya_bezopasnost_kompanii/?sphrase_id=153',
        '6675'=>'/courses/razvedka/tekhnologii_informatsionnogo_protivoborstva_v_internete/?sphrase_id=144',
        '2134'=>'/courses/razvedka/upravlenie_metodami_konkurentnoy_razvedki_v_internete/?sphrase_id=145',
        '6188'=>'/courses/s_terra/postroenie_zashchishchennykh_virtualnykh_setey_na_osnove_ipsec_s_ispolzovaniem_algoritmov_shifrovani/?sphrase_id=137',
        '5424'=>'/courses/razvedka/analiz_nestrukturirovannoy_informatsii/?sphrase_id=138',
        '2054'=>'/courses/razvedka/informatsionnaya_bezopasnost_v_internete/?sphrase_id=139',
        '6766'=>'/courses/os_rosa_kobalt/sertifitsirovannyy_administrator_os_rosa_kobalt/?sphrase_id=135',
        '6767'=>'/courses/os_rosa_kobalt/sertifitsirovannyy_polzovatel_os_rosa_kobalt/?sphrase_id=135',
        '1084'=>'/courses/informatsionnaya_bezopasnost_bankov/vnedrenie_i_otsenka_sootvetstviya_standartu_pci_dss/?sphrase_id=118',
        '166'=>'/courses/kursy_soglasovannye_s_federalnymi_organami/obespechenie_informatsionnoy_bezopasnosti_s_ispolzovaniem_shifrovalnykh_kriptograficheskikh_sredstv_/?sphrase_id=107',
        '3273'=>'/courses/avtorskie_kursy/upravlenie_intsidentami_informatsionnoy_bezopasnosti_prakticheskie_aspekty/?sphrase_id=102',
        '164'=>'/courses/avtorskie_kursy/upravlenie_riskami_informatsionnoy_bezopasnosti_sovremennoy_organizatsii_metodiki_i_prakticheskie_as/?sphrase_id=103',
        '155'=>'/courses/avtorskie_kursy/obespechenie_bezopasnosti_informatsionnykh_i_setevykh_resursov/?sphrase_id=97',
        '3277'=>'/courses/avtorskie_kursy/obespechenie_bezopasnosti_oblachnykh_vychisleniy/?sphrase_id=98',
        '830'=>'/courses/avtorskie_kursy/organizatsiya_i_vedenie_konfidentsialnogo_dokumentooborota_vklyuchaya_elektronnyy_dokumentooborot/?sphrase_id=99',
        '1037'=>'/courses/avtorskie_kursy/pravonarusheniya_v_sfere_kompyuternoy_informatsii_i_ikh_rassledovanie_prakticheskie_aspekty/?sphrase_id=100',
        '152'=>'/courses/avtorskie_kursy/kompleksnoe_obespechenie_informatsionnoy_bezopasnosti_v_organizatsii/?sphrase_id=94',
        '156'=>'/courses/avtorskie_kursy/audit_informatsionnoy_bezopasnosti_metodiki_i_prakticheskoe_primenenie/?sphrase_id=89',
        '163'=>'/courses/avtorskie_kursy/zashchita_besprovodnykh_setey/?sphrase_id=90',
        '3738'=>'/courses/avtorskie_kursy/dlp_sistemy/?sphrase_id=86',
        '6717'=>'/courses/avtorskie_kursy/audit_bezopasnosti_i_testirovanie_na_proniknovenie/?sphrase_id=87',
        '5796'=>'/courses/avtorizovannye_kursy/razvyertyvanie_uts_primenenie_skzi_i_ep_na_baze_pak_kriptopro_uts/?sphrase_id=81',
        '493'=>'/courses/mezhdunarod/vvedenie_v_sistemy_upravleniya_informatsionnoy_bezopasnostyu_i_iso_iec_27001_2013/?sphrase_id=67',
        '492'=>'/courses/mezhdunarod/vnedrenie_sistemy_upravleniya_informatsionnoy_bezopasnostyu_dlya_sootvetstviya_trebovaniyam_m_n_stan/?sphrase_id=68',
        '506'=>'/courses/mezhdunarod/vnutrenniy_audit_sistemy_upravleniya_informatsionnoy_bezopasnostyu_na_sootvetstvie_trebovaniyam_iso_/?sphrase_id=71',
        '5149'=>'/courses/mezhdunarod/podgotovka_vedushchego_auditora_sistem_upravleniya_informatsionnoy_bezopasnostyu_po_m_n_standartu_bs/?sphrase_id=77',
        '6702'=>"/",
        "6693"=>"/"
    ];
    header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: ".$redirect[$_GET['id']]); 
    exit(); 
}
?><? /*  весь код для главной страницы index.php перенесен во включаемые областя sect_footer.php sect_header.php и т.д. */ ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
