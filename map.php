<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=4c10efde-32c8-4e71-8c69-1b34c8931969&lang=ru_RU"
  type="text/javascript"></script>
</head>
<body style="margin: 0;">
    <script type="text/javascript">
        ymaps.ready(function(){
            var moscow_map = new ymaps.Map("YMapsID", {
                center: [55.76, 37.64],
                zoom: 10
            });
        });
    </script>

    <div id="YMapsID" style="width: 100%; height: 100vh;"></div>
</body>
</html>