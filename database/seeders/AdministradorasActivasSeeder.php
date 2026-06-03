<?php

namespace Database\Seeders;

use App\Models\AdministradorasActiva;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministradorasActivasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administradoras = [
            [
                'subsistema' => 'ARL',
                'codigo' => '14-4',
                'NIT' => 'N860002183',
                'razon_social' => 'SEGUROS DE VIDA COLPATRIA S.A.',
            ],
            [
                'subsistema' => 'ARL',
                'codigo' => '14-7',
                'NIT' => 'N860002503',
                'razon_social' => 'CIA. DE SEGUROS BOLIVAR S.A.',
            ],
            [
                'subsistema' => 'ARL',
                'codigo' => '14-8',
                'NIT' => 'N860022137',
                'razon_social' => 'COMPAÑIA DE SEGUROS DE VIDA AURORA',
            ],
            [
                'subsistema' => 'ARL',
                'codigo' => '14-18',
                'NIT' => 'N860503617',
                'razon_social' => 'SEGUROS DE VIDA ALFA S.A.',
            ],
            [
                'subsistema' => 'ARL',
                'codigo' => '14-23',
                'NIT' => 'N860008645',
                'razon_social' => 'LIBERTY SEGUROS DE VIDA ',
            ],
            [
                'subsistema' => 'ARL',
                'codigo' => '14-25',
                'NIT' => 'N860011153',
                'razon_social' => 'ARP - POSITIVA COMPAÑÍA DE SEGUROS',
            ],
            [
                'subsistema' => 'ARL',
                'codigo' => '14-28',
                'NIT' => 'N800226175',
                'razon_social' => 'RIESGOS PROFESIONALES COLMENA S.A COMPAÑÍA DE SEGUROS DE VIDA',
            ],
            [
                'subsistema' => 'ARL',
                'codigo' => '14-29',
                'NIT' => 'N800256161',
                'razon_social' => 'ARL- SURA',
            ],
            [
                'subsistema' => 'ARL',
                'codigo' => '14-30',
                'NIT' => 'N830008686',
                'razon_social' => ' LA EQUIDAD SEGUROS DE VIDA ORGANISMO COOPERATIVO - LA EQUIDAD VIDA',
            ],
            [
                'subsistema' => 'ARL',
                'codigo' => '14-30',
                'NIT' => 'N830054904',
                'razon_social' => 'MAPFRE COLOMBIA VIDA SEGUROS S.A. ',
            ],
            [
                'subsistema' => 'AFP',
                'codigo' => '230201',
                'NIT' => 'N800229739',
                'razon_social' => 'PROTECCIÓN',
            ],
            [
                'subsistema' => 'AFP',
                'codigo' => '230301',
                'NIT' => 'N800224808',
                'razon_social' => 'PORVENIR',
            ],
            [
                'subsistema' => 'AFP',
                'codigo' => '230901',
                'NIT' => 'N800253055',
                'razon_social' => 'OLD MUTUAL (ANTES SKANDIA)',
            ],
            [
                'subsistema' => 'AFP',
                'codigo' => '230904',
                'NIT' => 'N830125132',
                'razon_social' => 'OLD MUTUAL ALTERNA (ANTES SKANDIA)',
            ],
            [
                'subsistema' => 'AFP',
                'codigo' => '231001',
                'NIT' => 'N800227940',
                'razon_social' => 'COLFONDOS',
            ],
            [
                'subsistema' => 'AFP',
                'codigo' => '25-2',
                'NIT' => 'N860007379',
                'razon_social' => 'CAJA DE AUXILIOS Y PRESTACIONES DE LA ASOCIACIÓN COLOMBIANA DE AVIADORES CIVILES  ACDAC "CAXDAC"',
            ],
            [
                'subsistema' => 'AFP',
                'codigo' => '25-3',
                'NIT' => 'N899999734',
                'razon_social' => 'FONDO DE PREVISIÓN SOCIAL DEL CONGRESO DE LA REPÚBLICA – FONPRECON',
            ],
            [
                'subsistema' => 'AFP',
                'codigo' => '25-7',
                'NIT' => 'N800216278',
                'razon_social' => 'PENSIONES DE ANTIOQUIA',
            ],
            [
                'subsistema' => 'AFP',
                'codigo' => '25-14',
                'NIT' => 'N900336004',
                'razon_social' => 'COLPENSIONES',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF02',
                'NIT' => 'N890900840',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR CAMACOL  COMFAMILIAR CAMACOL',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF03',
                'NIT' => 'N890900842',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR COMFENALCO ANTIOQUIA',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF04',
                'NIT' => 'N890900841',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE ANTIOQUIA COMFAMA',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF05',
                'NIT' => 'N890102044',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR CAJACOPI ATLANTICO',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF06',
                'NIT' => 'N890102002',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE BARRANQUILLA COMBARRANQUILLA',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF07',
                'NIT' => 'N890101994',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR COMFAMILIAR DEL ATLANTICO',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF08',
                'NIT' => 'N890480023',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE FENALCO  - ANDI COMFENALCO CARTAGENA',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF09',
                'NIT' => 'N890480110',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE CARTAGENA',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF10',
                'NIT' => 'N891800213',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE BOYACA - COMFABOY',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF11',
                'NIT' => 'N890806490',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE CALDAS',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF13',
                'NIT' => 'N891190047',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DEL CAQUETÁ - COMFACA',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF14',
                'NIT' => 'N891500182',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DEL CAUCA - COMFACAUCA',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF15',
                'NIT' => 'N892399989',
                'razon_social' => 'COMFACESAR',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF16',
                'NIT' => 'N891080005',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE CORDOBA COMFACOR',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF21',
                'NIT' => 'N860013570',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR CAFAM',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF22',
                'NIT' => 'N860007336',
                'razon_social' => 'CAJA COLOMBIANA DE SUBSIDIO FAMILIAR COLSUBSIDIO',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF24',
                'NIT' => 'N860066942',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR COMPENSAR',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF26',
                'NIT' => 'N860045904',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE CUNDINAMARCA - COMFACUNDI',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF29',
                'NIT' => 'N891600091',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DEL CHOCÓ',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF30',
                'NIT' => 'N892115006',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE LA GUAJIRA',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF32',
                'NIT' => 'N891180008',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DEL HUILA - COMFAMILIAR',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF33',
                'NIT' => 'N891780093',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DEL MAGDALENA',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF34',
                'NIT' => 'N892000146',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR REGIONAL DEL META COFREM',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF35',
                'NIT' => 'N891280008',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE NARIÑO',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF36',
                'NIT' => 'N890500675',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DEL ORIENTE COLOMBIANO COMFAORIENTE',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF37',
                'NIT' => 'N890500516',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DEL NORTE DE SANTANDER COMFANORTE',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF38',
                'NIT' => 'N890270275',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE BARRANCABERMEJA CAFABA',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF39',
                'NIT' => 'N890200106',
                'razon_social' => 'CAJA SANTANDEREANA DE SUBSIDIO FAMILIAR CAJASAN',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF40',
                'NIT' => 'N890201578',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR COMFENALCO SANTANDER',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF41',
                'NIT' => 'N892200015',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE SUCRE',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF43',
                'NIT' => 'N890000381',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE FENALCO COMFENALCO QUINDIO',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF44',
                'NIT' => 'N891480000',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE RISARALDA - COMFAMILIAR RISARALDA',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF46',
                'NIT' => 'N890704737',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DEL SUR DEL TOLIMA CAFASUR',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF48',
                'NIT' => 'N800211025',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DEL TOLIMA COMFATOLIMA',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF50',
                'NIT' => 'N890700148',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE FENALCO DEL TOLIMA - COMFENALCO',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF56',
                'NIT' => 'N890303093',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR COMFENALCO DEL VALLE DEL CAUCA - COMFENALCO VALLE',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF57',
                'NIT' => 'N890303208',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DEL VALLE DEL CAUCA COMFAMILIAR ANDI - COMFANDI',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF63',
                'NIT' => 'N891200337',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DEL PUTUMAYO - COMFAMILIAR PUTUMAYO',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF64',
                'NIT' => 'N892400320',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE SAN ANDRES Y PROVIDENCIA, ISLAS CAJASAI',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF65',
                'NIT' => 'N800003122',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DEL AMAZONAS CAFAMAZ',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF67',
                'NIT' => 'N800219488',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DE ARAUCA COMFIAR',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF68',
                'NIT' => 'N800231969',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR CAMPESINA COMCAJA',
            ],
            [
                'subsistema' => 'CCF',
                'codigo' => 'CCF69',
                'NIT' => 'N844003392',
                'razon_social' => 'CAJA DE COMPENSACIÓN FAMILIAR DEL CASANARE - COMFACASANARE',
            ],

            ['subsistema' => 'PASENA', 'codigo' => 'PASENA', 'NIT' => 'N899999034',  'razon_social' => 'SENA'],
            ['subsistema' => 'PAICBF', 'codigo' => 'PAICBF', 'NIT' => 'N899999239',  'razon_social' => 'INSTITUTO COLOMBIANO DE BIENESTAR FAMILIAR'],
            ['subsistema' => 'PAMIED', 'codigo' => 'PAMIED', 'NIT' => 'N899999001',  'razon_social' => 'MINISTERIO DE EDUCACION'],
            ['subsistema' => 'PAESAP', 'codigo' => 'PAESAP', 'NIT' => 'N899999054',  'razon_social' => 'ESCUELA SUPERIOR DE ADMINISTRACION PUBLICA'],


            ['subsistema' => 'EPS', 'codigo' => 'EPS001', 'NIT' => 'N830113831', 'razon_social' => 'COLMÉDICA EPS - ALIANSALUD DESDE EL 01/01/2011'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS002', 'NIT' => 'N800130907', 'razon_social' => 'SALUD TOTAL S.A. ENTIDAD PROMOTORA DE SALUD'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS003', 'NIT' => 'N800140949', 'razon_social' => 'CAFESALUD MEDICINA PREPAGADA S.A.'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS005', 'NIT' => 'N800251440', 'razon_social' => 'ENTIDAD PROMOTORA DE SALUD SANITAS S.A.'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS008', 'NIT' => 'N860066942', 'razon_social' => 'COMPENSAR ENTIDAD PROMOTORA DE SALUD'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS010', 'NIT' => 'N800088702', 'razon_social' => 'EPS-SURA'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS012', 'NIT' => 'N890303093', 'razon_social' => 'COMFENALCO VALLE E.P.S.'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS013', 'NIT' => 'N800250119', 'razon_social' => 'ENTIDAD PROMOTORA DE SALUD ORGANISMO COOPERATIVO SALUDCOOP'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS016', 'NIT' => 'N805000427', 'razon_social' => 'COOMEVA ENTIDAD PROMOTORA DE SALUD S.A.'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS017', 'NIT' => 'N830003564', 'razon_social' => 'ENTIDAD PROMOTORA DE SALUD FAMISANAR LIMITADA CAFAM-COLSUBSIDIO'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS018', 'NIT' => 'N805001157', 'razon_social' => 'ENTIDAD PROMOTORA DE SALUD SERVICIO OCCIDENTAL DE SALUD S.A. S.O.S.'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS023', 'NIT' => 'N830009783', 'razon_social' => 'CRUZ BLANCA ENTIDAD PROMOTORA DE SALUD S.A.'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS033', 'NIT' => 'N830074184', 'razon_social' => 'SALUDVIDA S.A. ENTIDAD PROMOTORA DE SALUD'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS037', 'NIT' => 'N900156264', 'razon_social' => 'NUEVA EPS S.A - NUEVA EMPRESA PROMOTORA DE SALUD NUEVA EPS S.A'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS040', 'NIT' => 'N900604350', 'razon_social' => 'ALIANZA MEDELLIN ANTIOQUIA EPS SAS (SAVIA SALUD)'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS044', 'NIT' => 'N901097473', 'razon_social' => 'MEDIMAS EPS SAS'],
            ['subsistema' => 'EPS', 'codigo' => 'RES005', 'NIT' => 'N890102257', 'razon_social' => 'UNIVERSIDAD DEL ATLANTICO'],
            ['subsistema' => 'EPS', 'codigo' => 'RES006', 'NIT' => 'N890203183', 'razon_social' => 'UNIVERSIDAD DE SANT'],
            ['subsistema' => 'EPS', 'codigo' => 'RES007', 'NIT' => 'N890399010', 'razon_social' => 'UNIVERSIDAD DEL VALLE'],
            ['subsistema' => 'EPS', 'codigo' => 'RES008', 'NIT' => 'N899999063', 'razon_social' => 'UNIVERSIDAD NACIONAL DE COLOMBIA'],
            ['subsistema' => 'EPS', 'codigo' => 'RES009', 'NIT' => 'N891500319', 'razon_social' => 'UNIVERSIDAD CAUCA'],
            ['subsistema' => 'EPS', 'codigo' => 'RES011', 'NIT' => 'N890980040', 'razon_social' => 'PROGRAMA DE SALUD DE LA UNIVERSIDAD DE A'],
            ['subsistema' => 'EPS', 'codigo' => 'RES012', 'NIT' => 'N891080031', 'razon_social' => 'UNIVERSIDAD DE CORDOBA'],
            ['subsistema' => 'EPS', 'codigo' => 'RES013', 'NIT' => 'N800118954', 'razon_social' => 'UNIVERSIDAD DE NARIÑO'],
            ['subsistema' => 'EPS', 'codigo' => 'RES014', 'NIT' => 'N891800330', 'razon_social' => 'UPTC'],
            ['subsistema' => 'EPS', 'codigo' => 'RES010', 'NIT' => 'N806000509', 'razon_social' => 'UNIVERSIDAD DE CARTAGENA'],
            ['subsistema' => 'EPS', 'codigo' => 'CCFC15', 'NIT' => 'N891080005', 'razon_social' => 'EPS-S  COMFACOR'],
            ['subsistema' => 'EPS', 'codigo' => 'CCFC20', 'NIT' => 'N891600091', 'razon_social' => 'EPS-S COMPEN CHOCO'],
            ['subsistema' => 'EPS', 'codigo' => 'CCFC24', 'NIT' => 'N891180008', 'razon_social' => 'EPS-S COMF HUILA'],
            ['subsistema' => 'EPS', 'codigo' => 'CCFC27', 'NIT' => 'N891280008', 'razon_social' => 'EPS-CCFC COMFA NARIÑO'],
            ['subsistema' => 'EPS', 'codigo' => 'CCFC53', 'NIT' => 'N860045904', 'razon_social' => 'EPS-S COMFACUNDI'],
            ['subsistema' => 'EPS', 'codigo' => 'CCFC55', 'NIT' => 'N890102044', 'razon_social' => 'EPS-S CAJACOPI'],
            ['subsistema' => 'EPS', 'codigo' => 'EPSC03', 'NIT' => 'N800140949', 'razon_social' => 'Cafesalud Entidad Promotora de Salud S.A'],
            ['subsistema' => 'EPS', 'codigo' => 'EPSC22', 'NIT' => 'N899999107', 'razon_social' => 'EPS-S  CONVIDA'],
            ['subsistema' => 'EPS', 'codigo' => 'EPSC25', 'NIT' => 'N891856000', 'razon_social' => 'CAPRESOCA EPS'],
            ['subsistema' => 'EPS', 'codigo' => 'EPSC34', 'NIT' => 'N900298372', 'razon_social' => 'RECAUDO FOSYGA CAPITAL SALUD'],
            ['subsistema' => 'EPS', 'codigo' => 'EPSIC1', 'NIT' => 'N824001398', 'razon_social' => 'DUSAKAWI EPS'],
            ['subsistema' => 'EPS', 'codigo' => 'EPSIC2', 'NIT' => 'N812002376', 'razon_social' => 'ASOC DE CABILDO DE RESGUARDO INDIG ZENU'],
            ['subsistema' => 'EPS', 'codigo' => 'EPSIC3', 'NIT' => 'N817001773', 'razon_social' => 'ASOCIACION INDIGENA DEL CAUDA "A.I.C"'],
            ['subsistema' => 'EPS', 'codigo' => 'EPSIC5', 'NIT' => 'N837000084', 'razon_social' => 'ENTIDAD PROMOTORA DE SALUD MALLAMAS'],
            ['subsistema' => 'EPS', 'codigo' => 'EPSIC6', 'NIT' => 'N809008362', 'razon_social' => 'ENTIDAD PROMOTORA DE SALUD PIJAOSALUD E'],
            ['subsistema' => 'EPS', 'codigo' => 'ESSC02', 'NIT' => 'N811004055', 'razon_social' => 'EMP MUTUAL PARA EL DESAR ENDISALUD ESS'],
            ['subsistema' => 'EPS', 'codigo' => 'ESSC07', 'NIT' => 'N806008394', 'razon_social' => 'EPS-S MUTUAL SER'],
            ['subsistema' => 'EPS', 'codigo' => 'ESSC18', 'NIT' => 'N814000337', 'razon_social' => 'CMRC RECAUDO FOSYGA-EMSSANAR E.S.S'],
            ['subsistema' => 'EPS', 'codigo' => 'ESSC24', 'NIT' => 'N900226715', 'razon_social' => 'COOSALUD ESS EPS-S'],
            ['subsistema' => 'EPS', 'codigo' => 'ESSC33', 'NIT' => 'N804002105', 'razon_social' => 'EPS-S COMPARTA'],
            ['subsistema' => 'EPS', 'codigo' => 'ESSC62', 'NIT' => 'N900935126', 'razon_social' => 'ASMET SALUD EPS SAS'],
            ['subsistema' => 'EPS', 'codigo' => 'ESSC76', 'NIT' => 'N818000140', 'razon_social' => 'EPS-S AMBUQ  ASOCIACION MUTUAL BARRIOS UNIDOS DE QUIBDO E.S.S. AMBUQ'],
            ['subsistema' => 'EPS', 'codigo' => 'ESSC91', 'NIT' => 'N901093846', 'razon_social' => 'ENTIDAD COOPERATIVA SOLIDARIA “ECOOPSOS”'],
            ['subsistema' => 'EPS', 'codigo' => 'CCFC23', 'NIT' => 'N892115006', 'razon_social' => 'EPS-CCFC COM GUAJIRA'],
            ['subsistema' => 'EPS', 'codigo' => 'CCFC33', 'NIT' => 'N892200015', 'razon_social' => 'CAJA DE COMPENSACION FAMILIAR DE SUCRE'],
            ['subsistema' => 'EPS', 'codigo' => 'EPSIC4', 'NIT' => 'N839000495', 'razon_social' => 'ANAS WAYUU E P S I FOSYGA'],
            ['subsistema' => 'EPS', 'codigo' => 'CCFC09', 'NIT' => 'N891800213', 'razon_social' => 'EPS-S COMFABOY'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS041', 'NIT' => 'N900156264', 'razon_social' => 'CMRC.RECA.FOSYGA-NUEVAEPS R MOVILIDAD'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS042', 'NIT' => 'N900226715', 'razon_social' => 'COOSALUD'],
            ['subsistema' => 'EPS', 'codigo' => 'EPSC33', 'NIT' => 'N830074184', 'razon_social' => 'SALUDVIDA S.A. ENTIDAD PROMOTO'],
            ['subsistema' => 'EPS', 'codigo' => 'CCFC50', 'NIT' => 'N890500675', 'razon_social' => 'EPS-S COMFAORIENTE'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS045', 'NIT' => 'N901097473', 'razon_social' => 'MEDIMAS EPS SUBSIDIADO'],
            ['subsistema' => 'EPS', 'codigo' => 'EPS046', 'NIT' => 'N900914254', 'razon_social' => 'SALUD MIA EPS'],

            ['subsistema' => 'EAS', 'codigo' => 'EAS016', 'NIT' => 'N890904996', 'razon_social' => 'EMPRESAS PÚBLICAS DE MEDELLÍN DEPARTAMENTO MÉDICO'],
            ['subsistema' => 'EAS', 'codigo' => 'EAS027', 'NIT' => 'N8001128062', 'razon_social' => 'FONDO DE PASIVO SOCIAL DE FERROCARRILES NACIONALES DE COLOMBIA'],

            ['subsistema' => 'MIN', 'codigo' =>    'MIN001', 'NIT' => 'N901037916', 'razon_social' => 'ADMINISTRADORA DE LOS RECURSOS SS ADRES (antes FOSYGA)'],
            ['subsistema' => 'MIN', 'codigo' =>    'MIN002', 'NIT' => 'N901037916', 'razon_social' => 'ADMINISTRADORA DE LOS RECURSOS SS ADRES (antes FOSYGA)'],
            ['subsistema' => 'MIN', 'codigo' =>    'MIN003', 'NIT' => 'N901037916', 'razon_social' => 'ADMINISTRADORA DE LOS RECURSOS SS ADRES (antes FOSYGA)'],

            ['subsistema' => 'FSP',    'codigo' => 'FSP001', 'NIT' => 'N900619658', 'razon_social' => 'CONSORCIO COLOMBIA MAYOR 2013-FONDO DE SOLIDARIDAD PENSIONAL'],
            ['subsistema' => 'FSP',    'codigo' => 'ISSFSP', 'NIT' => 'N900336004', 'razon_social' => 'COLPENSIONES-I.SS.FSP'],

            ['subsistema' => 'AFP',    'codigo' => '0000', 'NIT' => '0000', 'razon_social' => 'NO APLICA'],
            ['subsistema' => 'EPS',    'codigo' => '0000', 'NIT' => '0000', 'razon_social' => 'NO APLICA'],
            ['subsistema' => 'CCF',    'codigo' => '0000', 'NIT' => '0000', 'razon_social' => 'NO APLICA'],
        ];

        foreach ($administradoras as $administradora) {
            if (!AdministradorasActiva::where('razon_social', $administradora['razon_social'])->where('subsistema', $administradora['subsistema'])->exists()) {
                AdministradorasActiva::insert($administradora);
            }
        }
    }
}
