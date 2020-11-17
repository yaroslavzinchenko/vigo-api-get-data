<?php
/*if ($_GET['getVigo'] != '1')
{
    exit();
}*/

require_once('MysqlConfig.php');
require_once('Config.php');

# Получаем последний день в виго.

$query = "select LAST_TIME_IN_VIGO from LAST_TIME_IN_VIGO";
if ($result = mysqli_query($link, $query)) {
    $row = mysqli_fetch_row($result);
    $lastTimeInVigo = $row[0];

    # Очищаем результирующий набор.
    mysqli_free_result($result);
}
# Закрываем подключение.
mysqli_close($link);

?>

Получение данных из Виго.
Для получения подробной информации откройте консоль (F12).

<!-- Синхронное получение данных. -->
<script>
    // Функция.
    // Принимает на вход объект Date.
    // Возвращает дату последнего воскресенья перед этой датой объектом Date.
    function getLastSunday() {
        let today = new Date();
        let day = today.getDay();
        let prevSunday;
        if (today.getDay() == 0) {
            lastSunday = new Date().setDate(today.getDate() - 7);
        } else {
            lastSunday = new Date().setDate(today.getDate() - day);
        }
        return new Date(lastSunday);
    }

    // функция.
    // Принимает дату в формате Date.
    // Возвращает строку этой даты в формате YYYY-MM-DD.
    function dateToString(date) {
        return String(date.getFullYear()) + "-" + ("0" + (date.getMonth() + 1)).slice(-2) + "-" + ("0" + date.getDate()).slice(-2);
    }

    // Функция.
    // Принимает на вход 2 параметра:
    // 1) Объект Date.
    // 2) Количество дней, которые необходимо прибавить к объекту Date.
    // Возвращает объект Date с прибавлением указанного количества дней.
    function addDays(dateObj, numDays) {
        dateObj.setDate(dateObj.getDate() + numDays);
        return dateObj;
    }

    // Функция.
    // Принимает на вход 2 объекта Date.
    // Возвращает количество целых дней между этими датами.
    function getDaysDifference(date1, date2) {
        date1 = new Date(dateToString(date1));
        date2 = new Date(dateToString(date2));
        if (date1 > date2) {
            return (Math.floor((date1 - date2) / 86400000)) - 1;
        } else {
            return (Math.floor((date2 - date1) / 86400000)) - 1;
        }
    }

    // Принимает на вход JSON и скармливает его PHP.
    function sendJsonToPHP(jsonForPHP) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", 'GetDataFromJsAndInsert.php');
        xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        xhr.setRequestHeader("Access-Control-Allow-Origin","*");

        try {
            xhr.send(jsonForPHP);
            if (xhr.status != 200) {
                console.log(`Код != 200 sendJsonToPHP status: ${xhr.status} `);
                console.log(`Код != 200 sendJsonToPHP statusText: ${xhr.statusText}`);
                console.log(`Код != 200 sendJsonToPHP readyState: ${xhr.readyState}`);
            } else {
                console.log("sendJsonToPHP: OK");
                //console.log(xhr.response);
            }
        } catch(err) {
            console.log(`Ошибка sendJsonToPHP status: ${xhr.status}`);
            console.log(`Ошибка sendJsonToPHP readyState: ${xhr.readyState}`);
            console.log(err);
        }
    }

    function wait(ms) {
        var start = new Date().getTime();
        var end = start;
        while(end < start + ms) {
            end = new Date().getTime();
        }
    }


    let lastTimeInVigo = "<?php echo $lastTimeInVigo; ?>";
    let lastTimeInVigoDate = new Date(lastTimeInVigo);
    console.log("Last time in Vigo string: " + lastTimeInVigo);
    console.log("Last time in Vigo date: " + lastTimeInVigoDate);

    let today = new Date();
    let todayString = dateToString(today);
    console.log("Today string: " + dateToString(today));
    console.log("Today date: " + today);
    console.log("Last Sunday date: " + getLastSunday(today));
    console.log("Last Monday after last Sunday string: " + dateToString(addDays(getLastSunday(today), 1)));

    console.log("Разница целых дней между сегодня и последним воскресенье: " + getDaysDifference(today, getLastSunday(today)));

    if (getDaysDifference(today, lastTimeInVigoDate) > 7)
    {
        console.log("С момента последнего получения данных Виго прошло более недели. Запуск скрипта.");

        let startDate = dateToString(addDays(new Date(lastTimeInVigo), 1));
        let finishDate = dateToString(getLastSunday(today));
        console.log("Start date: " + startDate);
        console.log("Finish date: " + finishDate);
        let daysDifference = getDaysDifference(getLastSunday(today), lastTimeInVigoDate);
        console.log("Разница целых дней между последним воскресенье и последним днём в Виго: " + daysDifference);

        let tftt = startDate;
        console.log("tftt: " + tftt);
        let success;
        for (let i = 0; i <= daysDifference; i++)
        {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'https://uxzoom.vigo.one/api/data-provider', false);
            /* xhr.responseType = 'json' ставить нельзя, потому что тогда будет выброшено DOMException.
            responseType нельзя ставить для синхронного запроса. */
            let requestBody = JSON.stringify(
                {
                    // Пример запроса.
                    "client":"<?php echo CLIENT; ?>",
                    "key":"<?php echo KEY; ?>",
                    "tf":"2020-10-07",
                    "tt":"2020-10-07",
                    "st":"1440",
                    "g":
                        {
                            "operator":
                                {
                                    "33":[33],
                                    "49":[49]
                                }
                        },
                    "p":["p"],
                    "f":
                        {
                            "ran_type":[2,3]
                        }
                }


                // Реальный запрос.
                /*{
                    "client":"<?php echo CLIENT; ?>",
                    "key":"<?php echo KEY; ?>",
                    "tf":tftt,
                    "tt":tftt,
                    "st":"1440",
                    "g":
                        {
                            "operator":
                                {
                                    "17": [17], "33": [33], "49": [49], "65": [65], "369": [369]
                                },
                            "region":
                                {
                                    "1":[1],"2":[2],"3":[3],"4":[4],"5":[5],"6":[6],"7":[7],"8":[8],"9":[9],"10":[10],
                                    "11":[11],"12":[12],"13":[13],"14":[14],"15":[15],"16":[16],"17":[17],"18":[18],"19":[19],"20":[20],
                                    "21":[21],"22":[22],"23":[23],"24":[24],"25":[25],"26":[26],"27":[27],"28":[28],"29":[29],"30":[30],
                                    "31":[31],"32":[32],"33":[33],"34":[34],"35":[35],"36":[36],"37":[37],"38":[38],"39":[39],"40":[40],
                                    "41":[41],"42":[42],"43":[43],"44":[44],"45":[45],"46":[46],"47":[47],"48":[48],"49":[49],"50":[50],
                                    "51":[51],"52":[52],"53":[53],"54":[54],"55":[55],"56":[56],"57":[57],"58":[58],"59":[59],"60":[60],
                                    "61":[61],"62":[62],"63":[63],"64":[64],"65":[65],"66":[66],"67":[67],"68":[68],"69":[69],"70":[70],
                                    "71":[71],"72":[72],"73":[73],"74":[74],"75":[75],"76":[76],"77":[77],"78":[78],"79":[79],"80":[80],
                                    "81":[81],"82":[82],"83":[83],"84":[84],"85":[85],
                                },
                            "ran_type":
                                {
                                    "2":[2],"3":[3],
                                },
                            "quality":
                                {
                                    "0":[0],"1":[1],"2":[2],"3":[3],"4":[4],"5":[5],"6":[6],"7":[7],"100":[100],
                                },
                        },
                    "p" : [
                        "p", "d", "sp", "bq_pwscpm_0", "bq_pwscpm_2", "bq_pwscpm_3", "bq_pwscpm_4", "bq_pwscpp_0", "bq_pwscpp_2",
                        "bq_pwscpp_3", "bq_pwscpp_4", "bq_pwstpm_1000", "bq_pwstpm_2000", "bq_pwstpm_3000", "bq_pwstpm_4000",
                        "bq_pwstpm_5000", "bq_sp_800", "bq_sp_1000", "bq_sp_1400", "bq_sp_2500", "bq_bdpm_10", "bq_bdpm_8", "bq_bdpm_6"
                    ],
                    "f":
                        {
                            "quality" : [100],
                        }
                }*/
            );
            xhr.setRequestHeader('Content-Type', 'application/json');
            try
            {
                xhr.send([requestBody]);
                if (xhr.status != 200) {
                    console.log(`Ошибка ${xhr.status}`);
                    console.log(`statusText: ${xhr.statusText}`);
                    console.log(`readyState: ${xhr.readyState}`);
                    success = 0;
                    break;
                } else {
                    console.log("Данные получены");

                    // Обрабатываем полученные от Виго данные.
                    let jsonForPHP = JSON.parse(xhr.response);
                    jsonForPHP = JSON.stringify(jsonForPHP);

                    // Скармливаем эти данные данные PHP.
                    sendJsonToPHP(jsonForPHP);
                    success = 1;
                }
            }
            catch(err)
            {
                console.log(err);
                console.log("Запрос не удался");
                success = 0;
                break;
            }

            if (tftt == finishDate) {
                break;
            } else {
                tftt = dateToString(addDays(new Date(tftt), 1));
                console.log("tftt: " + tftt);
            }

            // 1000мс - 1 секунда.
            wait(1000 * 30);
        }

        if (success === 1)
        {
            lastTimeInVigo = tftt;

        }
        else if (success === 0)
        {
            // В lastTimeInVigo записываем последний успешный день.
            lastTimeInVigo = addDays(new Date(tftt), -1);
        }
        lastTimeInVigo = dateToString(lastTimeInVigo);
        console.log("Last time in Vigo: " + lastTimeInVigo);

        let json = JSON.stringify({
            "lastTimeInVigo": lastTimeInVigo
        });

        let xhr = new XMLHttpRequest();
        xhr.open("POST", 'UpdateLastTimeInVigo.php');
        xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        try
        {
            xhr.send(json);
        }
        catch(err)
        {
            console.log(err);
            console.log("UpdateLastTimeInVigo. Запрос не удался.");
        }


        console.log("Конец");
    }
    else
    {
        console.log("С момента последнего получения данных Виго прошло менее недели. Запуск скрипта отменён.");
    }
</script>