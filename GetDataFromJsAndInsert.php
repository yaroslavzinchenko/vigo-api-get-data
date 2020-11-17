<?php

require_once('MysqlConfig.php');

header('Content-Type: application/json');
$post = file_get_contents('php://input');
$post = json_decode($post);

foreach($post as $instance)
{
    # Проверка на пустые значения нужна для того чтобы при подстановке переменных в sql-выражение
    # не было ошибок.

    if ($instance->time == '')
    {
        $TIME_KEY = 0;
    }
    else
    {
        $TIME_KEY = $instance->time;
    }
    if ($instance->key->quality == '')
    {
        $OPERATOR = 0;
    }
    else
    {
        $OPERATOR = $instance->key->operator;
    }
    if ($instance->key->quality == '')
    {
        $QUALITY = 0;
    }
    else
    {
        $QUALITY = $instance->key->quality;
    }
    if ($instance->key->ran_type == '')
    {
        $RAN_TYPE = 0;
    }
    else
    {
        $RAN_TYPE = $instance->key->ran_type;
    }
    if ($instance->key->region == '')
    {
        $REGION = 0;
    }
    else
    {
        $REGION = $instance->key->region;
    }
    if ($instance->value->p == '')
    {
        $P = 0;
    }
    else
    {
        $P = $instance->value->p;
    }
    if ($instance->value->d == '')
    {
        $D = 0;
    }
    else
    {
        $D = $instance->value->d;
    }
    if ($instance->value->sp == '')
    {
        $SP = 0;
    }
    else
    {
        $SP = $instance->value->sp;
    }
    if ($instance->value->bq_pwscpm_0 == '')
    {
        $BQ_PWSCPM_0 = 0;
    }
    else
    {
        $BQ_PWSCPM_0 = $instance->value->bq_pwscpm_0;
    }
    if ($instance->value->bq_pwscpm_2 == '')
    {
        $BQ_PWSCPM_2 = 0;
    }
    else
    {
        $BQ_PWSCPM_2 = $instance->value->bq_pwscpm_2;
    }
    if ($instance->value->bq_pwscpm_3 == '')
    {
        $BQ_PWSCPM_3 = 0;
    }
    else
    {
        $BQ_PWSCPM_3 = $instance->value->bq_pwscpm_3;
    }
    if ($instance->value->bq_pwscpm_4 == '')
    {
        $BQ_PWSCPM_4 = 0;
    }
    else
    {
        $BQ_PWSCPM_4 = $instance->value->bq_pwscpm_4;
    }
    if ($instance->value->bq_pwscpp_0 == '')
    {
        $BQ_PWSCPP_0 = 0;
    }
    else
    {
        $BQ_PWSCPP_0 = $instance->value->bq_pwscpp_0;
    }
    if ($instance->value->bq_pwscpp_2 == '')
    {
        $BQ_PWSCPP_2 = 0;
    }
    else
    {
        $BQ_PWSCPP_2 = $instance->value->bq_pwscpp_2;
    }
    if ($instance->value->bq_pwscpp_3 == '')
    {
        $BQ_PWSCPP_3 = 0;
    }
    else
    {
        $BQ_PWSCPP_3 = $instance->value->bq_pwscpp_3;
    }
    if ($instance->value->bq_pwscpp_4 == '')
    {
        $BQ_PWSCPP_4 = 0;
    }
    else
    {
        $BQ_PWSCPP_4 = $instance->value->bq_pwscpp_4;
    }
    if ($instance->value->bq_pwstpm_1000 == '')
    {
        $BQ_PWSTPM_1000 = 0;
    }
    else
    {
        $BQ_PWSTPM_1000 = $instance->value->bq_pwstpm_1000;
    }
    if ($instance->value->bq_pwstpm_2000 == '')
    {
        $BQ_PWSTPM_2000 = 0;
    }
    else
    {
        $BQ_PWSTPM_2000 = $instance->value->bq_pwstpm_2000;
    }
    if ($instance->value->bq_pwstpm_3000 == '')
    {
        $BQ_PWSTPM_3000 = 0;
    }
    else
    {
        $BQ_PWSTPM_3000 = $instance->value->bq_pwstpm_3000;
    }
    if ($instance->value->bq_pwstpm_4000 == '')
    {
        $BQ_PWSTPM_4000 = 0;
    }
    else
    {
        $BQ_PWSTPM_4000 = $instance->value->bq_pwstpm_4000;
    }
    if ($instance->value->bq_pwstpm_5000 == '')
    {
        $BQ_PWSTPM_5000 = 0;
    }
    else
    {
        $BQ_PWSTPM_5000 = $instance->value->bq_pwstpm_5000;
    }
    if ($instance->value->bq_sp_800 == '')
    {
        $BQ_SP_800 = 0;
    }
    else
    {
        $BQ_SP_800 = $instance->value->bq_sp_800;
    }
    if ($instance->value->bq_sp_1000 == '')
    {
        $BQ_SP_1000 = 0;
    }
    else
    {
        $BQ_SP_1000 = $instance->value->bq_sp_1000;
    }
    if ($instance->value->bq_sp_1400 == '')
    {
        $BQ_SP_1400 = 0;
    }
    else
    {
        $BQ_SP_1400 = $instance->value->bq_sp_1400;
    }
    if ($instance->value->bq_sp_2500 == '')
    {
        $BQ_SP_2500 = 0;
    }
    else
    {
        $BQ_SP_2500 = $instance->value->bq_sp_2500;
    }
    if ($instance->value->bq_bdpm_10 == '')
    {
        $BQ_BDPM_10 = 0;
    }
    else
    {
        $BQ_BDPM_10 = $instance->value->bq_bdpm_10;
    }
    if ($instance->value->bq_bdpm_8 == '')
    {
        $BQ_BDPM_8 = 0;
    }
    else
    {
        $BQ_BDPM_8 = $instance->value->bq_bdpm_8;
    }
    if ($instance->value->bq_bdpm_6 == '')
    {
        $BQ_BDPM_6 = 0;
    }
    else
    {
        $BQ_BDPM_6 = $instance->value->bq_bdpm_6;
    }

    $sql = "
                    INSERT INTO VIGO 
                        (
                        TIME_KEY, 
                        OPERATOR, 
                        REGION, 
                        RAN_TYPE, 
                        QUALITY,
                        P, 
                        D, 
                        SP,
                        BQ_PWSCPM_0,
                        BQ_PWSCPM_2,
                        BQ_PWSCPM_3,
                        BQ_PWSCPM_4,
                        BQ_PWSCPP_0,
                        BQ_PWSCPP_2,
                        BQ_PWSCPP_3,
                        BQ_PWSCPP_4,
                        BQ_PWSTPM_1000,
                        BQ_PWSTPM_2000,
                        BQ_PWSTPM_3000,
                        BQ_PWSTPM_4000,
                        BQ_PWSTPM_5000,
                        BQ_SP_800,
                        BQ_SP_1000,
                        BQ_SP_1400,
                        BQ_SP_2500,
                        BQ_BDPM_10,
                        BQ_BDPM_8,
                        BQ_BDPM_6
                        )
                    VALUES 
                    (
                    {$TIME_KEY}, 
                    {$OPERATOR}, 
                    {$REGION}, 
                    {$RAN_TYPE}, 
                    {$QUALITY},
                    {$P}, 
                    {$D}, 
                    {$SP},
                    {$BQ_PWSCPM_0},
                    {$BQ_PWSCPM_2},
                    {$BQ_PWSCPM_3},
                    {$BQ_PWSCPM_4},
                    {$BQ_PWSCPP_0},
                    {$BQ_PWSCPP_2},
                    {$BQ_PWSCPP_3},
                    {$BQ_PWSCPP_4},
                    {$BQ_PWSTPM_1000},
                    {$BQ_PWSTPM_2000},
                    {$BQ_PWSTPM_3000},
                    {$BQ_PWSTPM_4000},
                    {$BQ_PWSTPM_5000},
                    {$BQ_SP_800},
                    {$BQ_SP_1000},
                    {$BQ_SP_1400},
                    {$BQ_SP_2500},
                    {$BQ_BDPM_10},
                    {$BQ_BDPM_8},
                    {$BQ_BDPM_6}
                    )
                ";

    if (mysqli_query($link, $sql) === TRUE) {
        printf("Inserted into Vigo.\n");
    }
}