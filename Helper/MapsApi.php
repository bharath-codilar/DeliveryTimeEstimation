<?php
/**
 * @package     hackathon
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\DeliveryTimeEstimation\Helper;


use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Codilar\DeliveryTimeEstimation\Helper\Data;
use Psr\Log\LoggerInterface;

class MapsApi extends AbstractHelper
{
    /**
     * @var \Codilar\DeliveryTimeEstimation\Helper\Data
     */
    private $data;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * MapsApi constructor.
     * @param Context $context
     * @param \Codilar\DeliveryTimeEstimation\Helper\Data $data
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        Data $data,
    LoggerInterface $logger
        )
    {
        parent::__construct($context);
        $this->data = $data;
        $this->logger = $logger;
    }

    public function getCustomerLocation($destination) {
        $apiKey = $result = str_replace('"', '', $this->data->getApiKey());
        $warehouseAddress = str_replace('"', '', $this->data->getWareHouseAddress());
        $origin = str_replace(' ', '+', $warehouseAddress);
        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=".$origin."&destination=".$destination."&key=".$apiKey;
        $this->logger->info($url);
//        $mapsApi = curl_init($url);
//        $mapsData = curl_exec($mapsApi);
        $mapsData = '{
   "geocoded_waypoints" : [
      {
         "geocoder_status" : "OK",
         "place_id" : "ChIJI-fSfCYVrjsRkObxbhrzJg8",
         "types" : [ "establishment", "point_of_interest" ]
      },
      {
         "geocoder_status" : "OK",
         "place_id" : "Enk3NDUsIDV0aCBNYWluIFJkLCBTcmluaXZhc2FuYWdhcmEsIEhhbnVtYW50aG5hZ2FyLCBCYW5hc2hhbmthcmkgU3RhZ2UgSSwgQmFuYXNoYW5rYXJpLCBCZW5nYWx1cnUsIEthcm5hdGFrYSA1NjAwMTksIEluZGlhIhsSGQoUChIJhUd5W_UVrjsRegJaWyxdd1IQ6QU",
         "types" : [ "street_address" ]
      }
   ],
   "routes" : [
      {
         "bounds" : {
            "northeast" : {
               "lat" : 12.94527,
               "lng" : 77.6156984
            },
            "southwest" : {
               "lat" : 12.916074,
               "lng" : 77.5624564
            }
         },
         "copyrights" : "Map data ©2019 Google",
         "legs" : [
            {
               "distance" : {
                  "text" : "8.8 km",
                  "value" : 8839
               },
               "duration" : {
                  "text" : "32 mins",
                  "value" : 1896
               },
               "end_address" : "745, 5th Main Rd, Srinivasanagara, Hanumanthnagar, Banashankari Stage I, Banashankari, Bengaluru, Karnataka 560019, India",
               "end_location" : {
                  "lat" : 12.9440167,
                  "lng" : 77.5625465
               },
               "start_address" : "Sai Manasa, 703, 30th Main Rd, Jayanagar 9th Block East, Kuvempu Nagar, Stage 2, BTM 2nd Stage, Bengaluru, Karnataka 560076, India",
               "start_location" : {
                  "lat" : 12.916074,
                  "lng" : 77.6156776
               },
               "steps" : [
                  {
                     "distance" : {
                        "text" : "22 m",
                        "value" : 22
                     },
                     "duration" : {
                        "text" : "1 min",
                        "value" : 7
                     },
                     "end_location" : {
                        "lat" : 12.9162753,
                        "lng" : 77.6156984
                     },
                     "html_instructions" : "Head \u003cb\u003enorth\u003c/b\u003e on \u003cb\u003e30th Main Rd\u003c/b\u003e toward \u003cb\u003e100 Feet Ring Rd\u003c/b\u003e/\u003cb\u003eOuter Ring Rd\u003c/b\u003e",
                     "polyline" : {
                        "points" : "mtymA_ivxMi@C"
                     },
                     "start_location" : {
                        "lat" : 12.916074,
                        "lng" : 77.6156776
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "47 m",
                        "value" : 47
                     },
                     "duration" : {
                        "text" : "1 min",
                        "value" : 19
                     },
                     "end_location" : {
                        "lat" : 12.916324,
                        "lng" : 77.6152699
                     },
                     "html_instructions" : "Turn \u003cb\u003eleft\u003c/b\u003e onto \u003cb\u003e100 Feet Ring Rd\u003c/b\u003e/\u003cb\u003eOuter Ring Rd\u003c/b\u003e",
                     "maneuver" : "turn-left",
                     "polyline" : {
                        "points" : "wuymAcivxMGtA"
                     },
                     "start_location" : {
                        "lat" : 12.9162753,
                        "lng" : 77.6156984
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "1.6 km",
                        "value" : 1650
                     },
                     "duration" : {
                        "text" : "7 mins",
                        "value" : 412
                     },
                     "end_location" : {
                        "lat" : 12.9166554,
                        "lng" : 77.60005099999999
                     },
                     "html_instructions" : "Continue straight past Priya Bakery to stay on \u003cb\u003e100 Feet Ring Rd\u003c/b\u003e/\u003cb\u003eOuter Ring Rd\u003c/b\u003e\u003cdiv style=\"font-size:0.9em\"\u003ePass by Federal Bank ATM (on the left)\u003c/div\u003e",
                     "maneuver" : "straight",
                     "polyline" : {
                        "points" : "_vymAmfvxMANGpAEdAEvBAbG?v@E~GAr@CpAANAbDAtGCxAChBAtC?DA\\?|AExG@hEEzFCzI"
                     },
                     "start_location" : {
                        "lat" : 12.916324,
                        "lng" : 77.6152699
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "0.5 km",
                        "value" : 533
                     },
                     "duration" : {
                        "text" : "3 mins",
                        "value" : 152
                     },
                     "end_location" : {
                        "lat" : 12.9167954,
                        "lng" : 77.5951323
                     },
                     "html_instructions" : "Continue onto \u003cb\u003eMarenahalli Rd\u003c/b\u003e\u003cdiv style=\"font-size:0.9em\"\u003ePass by Valtech (on the left)\u003c/div\u003e",
                     "polyline" : {
                        "points" : "cxymAigsxM?r@Af@AlD?t@A`B@fAEbACjA?F?DG~D?dAEhA"
                     },
                     "start_location" : {
                        "lat" : 12.9166554,
                        "lng" : 77.60005099999999
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "0.4 km",
                        "value" : 427
                     },
                     "duration" : {
                        "text" : "2 mins",
                        "value" : 100
                     },
                     "end_location" : {
                        "lat" : 12.9205463,
                        "lng" : 77.5951656
                     },
                     "html_instructions" : "Turn \u003cb\u003eright\u003c/b\u003e after Hotel Smile (on the left)\u003cdiv style=\"font-size:0.9em\"\u003ePass by Shekhar Hospital Jayanagar (on the left)\u003c/div\u003e",
                     "maneuver" : "turn-right",
                     "polyline" : {
                        "points" : "_yymAqhrxM?NM?IGYA}JG}HE"
                     },
                     "start_location" : {
                        "lat" : 12.9167954,
                        "lng" : 77.5951323
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "1.0 km",
                        "value" : 1000
                     },
                     "duration" : {
                        "text" : "3 mins",
                        "value" : 174
                     },
                     "end_location" : {
                        "lat" : 12.9206851,
                        "lng" : 77.5859487
                     },
                     "html_instructions" : "Turn \u003cb\u003eleft\u003c/b\u003e after Ssignature Properties (on the left)\u003cdiv style=\"font-size:0.9em\"\u003ePass by the pharmacy (on the left)\u003c/div\u003e",
                     "maneuver" : "turn-left",
                     "polyline" : {
                        "points" : "mpzmAyhrxM?@?fAAjACvBAt@@V?^AbAA|AA~A?hBAxAAzAA`BChA?@?J?N?vB?F?H@LDt@AvAE`BAvAAxAApC"
                     },
                     "start_location" : {
                        "lat" : 12.9205463,
                        "lng" : 77.5951656
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "0.3 km",
                        "value" : 299
                     },
                     "duration" : {
                        "text" : "1 min",
                        "value" : 58
                     },
                     "end_location" : {
                        "lat" : 12.9232932,
                        "lng" : 77.58591009999999
                     },
                     "html_instructions" : "Turn \u003cb\u003eright\u003c/b\u003e onto \u003cb\u003e11th Main Rd\u003c/b\u003e/\u003cb\u003eAurobindo Marg\u003c/b\u003e\u003cdiv style=\"font-size:0.9em\"\u003ePass by Shri Matha Annapoorneshwari Temple, Jaya Nagar (on the left)\u003c/div\u003e",
                     "maneuver" : "turn-right",
                     "polyline" : {
                        "points" : "iqzmAeopxM?PqECuHE"
                     },
                     "start_location" : {
                        "lat" : 12.9206851,
                        "lng" : 77.5859487
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "0.6 km",
                        "value" : 607
                     },
                     "duration" : {
                        "text" : "2 mins",
                        "value" : 99
                     },
                     "end_location" : {
                        "lat" : 12.9234279,
                        "lng" : 77.58030890000001
                     },
                     "html_instructions" : "Turn \u003cb\u003eleft\u003c/b\u003e after Stayfit Health &amp; Fitness World Pvt. Ltd. (on the left)",
                     "maneuver" : "turn-left",
                     "polyline" : {
                        "points" : "qa{mA}npxM?`BArBKtBAzA?NCbEAtA?~AA~B?xACrA"
                     },
                     "start_location" : {
                        "lat" : 12.9232932,
                        "lng" : 77.58591009999999
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "1.5 km",
                        "value" : 1489
                     },
                     "duration" : {
                        "text" : "5 mins",
                        "value" : 291
                     },
                     "end_location" : {
                        "lat" : 12.9366785,
                        "lng" : 77.5800457
                     },
                     "html_instructions" : "Turn \u003cb\u003eright\u003c/b\u003e onto \u003cb\u003e4th Main Rd\u003c/b\u003e/\u003cb\u003eRashtriya Vidyalaya Rd\u003c/b\u003e\u003cdiv style=\"font-size:0.9em\"\u003ePass by Metro Pillar Number 30 (on the right in 400&nbsp;m)\u003c/div\u003e",
                     "maneuver" : "turn-right",
                     "polyline" : {
                        "points" : "mb{mA}koxM?ZI?C?eQDeDBmH?{I?_A@M?_A@sJDsB@kGBwG?a@?YA"
                     },
                     "start_location" : {
                        "lat" : 12.9234279,
                        "lng" : 77.58030890000001
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "0.5 km",
                        "value" : 456
                     },
                     "duration" : {
                        "text" : "1 min",
                        "value" : 88
                     },
                     "end_location" : {
                        "lat" : 12.9397949,
                        "lng" : 77.57738119999999
                     },
                     "html_instructions" : "Slight \u003cb\u003eleft\u003c/b\u003e at \u003cb\u003eS End Cir\u003c/b\u003e onto \u003cb\u003ePattalamma Temple Rd\u003c/b\u003e\u003cdiv style=\"font-size:0.9em\"\u003ePass by Cafe Mondo (on the left in 400&nbsp;m)\u003c/div\u003e",
                     "maneuver" : "turn-slight-left",
                     "polyline" : {
                        "points" : "gu}mAijoxMSRc@ZKHqFjEyDhCkBpACBABCDABE`@"
                     },
                     "start_location" : {
                        "lat" : 12.9366785,
                        "lng" : 77.5800457
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "0.1 km",
                        "value" : 132
                     },
                     "duration" : {
                        "text" : "1 min",
                        "value" : 21
                     },
                     "end_location" : {
                        "lat" : 12.9406389,
                        "lng" : 77.5769014
                     },
                     "html_instructions" : "At \u003cb\u003eArmugam Cir\u003c/b\u003e, take the \u003cb\u003e2nd\u003c/b\u003e exit onto \u003cb\u003eDewan Madhava Rao Rd\u003c/b\u003e",
                     "maneuver" : "roundabout-left",
                     "polyline" : {
                        "points" : "uh~mAsynxM?D?D@DAD?D?DADADCFCDCFEDEDEDEBGBIBG@I@I?G?IAICGAo@?"
                     },
                     "start_location" : {
                        "lat" : 12.9397949,
                        "lng" : 77.57738119999999
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "0.3 km",
                        "value" : 336
                     },
                     "duration" : {
                        "text" : "1 min",
                        "value" : 51
                     },
                     "end_location" : {
                        "lat" : 12.9436606,
                        "lng" : 77.5769152
                     },
                     "html_instructions" : "Continue onto \u003cb\u003eKanakapura Rd\u003c/b\u003e",
                     "polyline" : {
                        "points" : "_n~mAsvnxMgHF{DAcACs@E"
                     },
                     "start_location" : {
                        "lat" : 12.9406389,
                        "lng" : 77.5769014
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "0.3 km",
                        "value" : 332
                     },
                     "duration" : {
                        "text" : "1 min",
                        "value" : 53
                     },
                     "end_location" : {
                        "lat" : 12.9436688,
                        "lng" : 77.5738552
                     },
                     "html_instructions" : "Turn \u003cb\u003eleft\u003c/b\u003e after The Kenmore English School (on the right)\u003cdiv style=\"font-size:0.9em\"\u003ePass by Indian Institute of World Culture (on the right)\u003c/div\u003e",
                     "maneuver" : "turn-left",
                     "polyline" : {
                        "points" : "{`_nAwvnxMApP?p@"
                     },
                     "start_location" : {
                        "lat" : 12.9436606,
                        "lng" : 77.5769152
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "0.7 km",
                        "value" : 655
                     },
                     "duration" : {
                        "text" : "3 mins",
                        "value" : 150
                     },
                     "end_location" : {
                        "lat" : 12.9436412,
                        "lng" : 77.5678216
                     },
                     "html_instructions" : "At \u003cb\u003eTagore Cir\u003c/b\u003e, continue onto \u003cb\u003eBugle Rock Rd\u003c/b\u003e\u003cdiv style=\"font-size:0.9em\"\u003ePass by BMS Womens College (on the right in 400&nbsp;m)\u003c/div\u003e",
                     "polyline" : {
                        "points" : "}`_nAscnxM?b@@t@AbBD^CfA?pB@nCElA?@HjA@|CA`DCfA?@@hB"
                     },
                     "start_location" : {
                        "lat" : 12.9436688,
                        "lng" : 77.5738552
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "0.2 km",
                        "value" : 153
                     },
                     "duration" : {
                        "text" : "1 min",
                        "value" : 42
                     },
                     "end_location" : {
                        "lat" : 12.9449991,
                        "lng" : 77.5677529
                     },
                     "html_instructions" : "Turn \u003cb\u003eright\u003c/b\u003e after Sri Dharmastala Manjunatha Swamy Kalyana Mantapa (on the left)",
                     "maneuver" : "turn-right",
                     "polyline" : {
                        "points" : "w`_nA{}lxMSCSHm@@gB@a@@o@@"
                     },
                     "start_location" : {
                        "lat" : 12.9436412,
                        "lng" : 77.5678216
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "0.6 km",
                        "value" : 557
                     },
                     "duration" : {
                        "text" : "2 mins",
                        "value" : 141
                     },
                     "end_location" : {
                        "lat" : 12.9451661,
                        "lng" : 77.56269379999999
                     },
                     "html_instructions" : "Turn \u003cb\u003eleft\u003c/b\u003e onto \u003cb\u003e9th Cross Rd\u003c/b\u003e/\u003cb\u003eSri Nijagunara Rd\u003c/b\u003e\u003cdiv style=\"font-size:0.9em\"\u003eContinue to follow 9th Cross Rd\u003c/div\u003e\u003cdiv style=\"font-size:0.9em\"\u003ePass by SBN Hall (on the right)\u003c/div\u003e",
                     "maneuver" : "turn-left",
                     "polyline" : {
                        "points" : "gi_nAm}lxM?LEj@[dAOZ@~@AlAAh@AT?@BpA?h@?r@@tAAjAClA?jA?`@?|@@TFRHP"
                     },
                     "start_location" : {
                        "lat" : 12.9449991,
                        "lng" : 77.5677529
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "39 m",
                        "value" : 39
                     },
                     "duration" : {
                        "text" : "1 min",
                        "value" : 9
                     },
                     "end_location" : {
                        "lat" : 12.944866,
                        "lng" : 77.56251109999999
                     },
                     "html_instructions" : "Slight \u003cb\u003eleft\u003c/b\u003e onto \u003cb\u003e5th Main Rd\u003c/b\u003e/\u003cb\u003e9th Cross Rd\u003c/b\u003e",
                     "maneuver" : "turn-slight-left",
                     "polyline" : {
                        "points" : "ij_nAy}kxMz@b@"
                     },
                     "start_location" : {
                        "lat" : 12.9451661,
                        "lng" : 77.56269379999999
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "76 m",
                        "value" : 76
                     },
                     "duration" : {
                        "text" : "1 min",
                        "value" : 21
                     },
                     "end_location" : {
                        "lat" : 12.9441868,
                        "lng" : 77.5624564
                     },
                     "html_instructions" : "Continue straight past Maradi Subbaiah Trust Kalyana Mantapa onto \u003cb\u003e5th Main Rd\u003c/b\u003e",
                     "maneuver" : "straight",
                     "polyline" : {
                        "points" : "mh_nAu|kxMJBJ@T@V@`A?"
                     },
                     "start_location" : {
                        "lat" : 12.944866,
                        "lng" : 77.56251109999999
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "10 m",
                        "value" : 10
                     },
                     "duration" : {
                        "text" : "1 min",
                        "value" : 3
                     },
                     "end_location" : {
                        "lat" : 12.9441855,
                        "lng" : 77.56255279999999
                     },
                     "html_instructions" : "Turn \u003cb\u003eleft\u003c/b\u003e onto \u003cb\u003e6th Cross Rd\u003c/b\u003e",
                     "maneuver" : "turn-left",
                     "polyline" : {
                        "points" : "ed_nAk|kxM?Q"
                     },
                     "start_location" : {
                        "lat" : 12.9441868,
                        "lng" : 77.5624564
                     },
                     "travel_mode" : "DRIVING"
                  },
                  {
                     "distance" : {
                        "text" : "19 m",
                        "value" : 19
                     },
                     "duration" : {
                        "text" : "1 min",
                        "value" : 5
                     },
                     "end_location" : {
                        "lat" : 12.9440167,
                        "lng" : 77.5625465
                     },
                     "html_instructions" : "Turn \u003cb\u003eright\u003c/b\u003e onto \u003cb\u003e5th Main Rd\u003c/b\u003e",
                     "maneuver" : "turn-right",
                     "polyline" : {
                        "points" : "ed_nA}|kxM`@?"
                     },
                     "start_location" : {
                        "lat" : 12.9441855,
                        "lng" : 77.56255279999999
                     },
                     "travel_mode" : "DRIVING"
                  }
               ],
               "traffic_speed_entry" : [],
               "via_waypoint" : []
            }
         ],
         "overview_polyline" : {
            "points" : "mtymA_ivxMi@CGtAI`BK|DAzHMtLCxLGbECvGCbNIvQAzAAbF?hDInCGrGExAM?IGwKI}HCG`I@v@C`DE~JExD?xCFbAGxDEtIgOIAtEKtBAzACrECnKCnBI?iQDsMBiNBgNFcPB{@Aw@n@}FtEeHzEKPEf@@JCVMZWTc@Je@Ew@AgHF{DAwBIAbR@xAAbBD^CxD@nCElAHlA?~HChA@hBSCSHm@@iCBo@@?LEj@[dAOZ@~@CvB@rC@hCExC?lB@rAPd@fAf@`@BxA@?Q`@?"
         },
         "summary" : "100 Feet Ring Rd/Outer Ring Rd",
         "warnings" : [],
         "waypoint_order" : []
      }
   ],
   "status" : "OK"
}';
        return json_decode($mapsData);
    }
}