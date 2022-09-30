<?php
require_once("php/DBOperations.php");
require_once("php/InterfaceElemets.php");
require_once("php/MaskValidator.php");

?>
<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Добавление оборудования</title>
</head>

<body>
    <div class="container">
        <div class=" text-center mt-5 ">
            <h1>Добавление оборудования</h1>
        </div>
        <div class="row ">
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container">

                            <form id="form" role="form" method="POST">
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="serials">Сериные номера*</label>
                                                <textarea id="serials" name="serials" class="form-control" placeholder="Введите серийные номера в это поле" rows="10" required="required" data-error="Please, leave us a message."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="type">Тип оборудования*</label>
                                                <select id="type" name="type" class="form-control" required="required">
                                                    <option value="" selected disabled>--Выберете тип оборудования--</option>
                                                    <?php InterfaceElemets::printTypeSelectOptions(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-success btn-send float-end  mt-4  pt-2 btn-block" value="Сохранить">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['type']) && isset($_POST['serials'])) {

                                $mask = DBOperations::getSerialMaskById($_POST['type']);

                                $serials = explode("\n", $_POST['serials']);
                                foreach ($serials as &$serial) {
                                    $serial = trim($serial);
                                }
                                $serials = array_diff($serials, array(''));
                                $serials = array_unique($serials);

                                $validator = new MaskValidator($mask);
                                $validator->validateArr($serials);
                                $validated = $validator->getValid();
                                $notValidated = $validator->getNotValid();

                                $result = DBOperations::writeHardware($_POST['type'], $validated);
                                $result['validated'] = $validated;
                                $result['notValidated'] = $notValidated;

                                InterfaceElemets::printLogMessage($result);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /.8 -->
            </div>
            <!-- /.row-->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>