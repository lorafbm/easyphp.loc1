<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!--<script>-->
<!--    function incSize(event) {-->
<!--        var width = Number(event.target.style.width.substring(0, event.target.style.width.length - 2));-->
<!--        event.target.style.width = (width + 5) + 'px';-->
<!--    }-->
<!---->
<!--    $(document).ready(function () {-->
<!--        $('div').click(incSize);-->
<!---->
<!--    });-->
<!--</script>-->
<!--<div style="height: 50px; width: 50px; background-color: red;"></div>-->
<!--<div style="height: 50px; width: 50px; background-color: green;"></div>-->
<!--<div style="height: 50px; width: 50px; background-color: blue;"></div>-->
<!---->
<!---->
<!--<p class="scolor" style="color:red;">Red</p>-->
<!--<script type="text/javascript">-->
<!--    $(document).ready(function () {-->
<!--        $('.scolor').click(function () {-->
<!--            if ($(this).css('color') == 'rgb(0, 0, 255)') {-->
<!--                $(this).css('color', 'red');-->
<!--                $(this).html('Red');-->
<!--            } else {-->
<!--                $(this).css('color', 'blue');-->
<!--                $(this).html('Blue');-->
<!--            }-->
<!--        });-->
<!--    });-->
<!--</script>-->
<!---->
<!---->
<!--<div class="desc" style="font-size: 30px;">Концертный зал.</div>-->
<!--<script type="text/javascript">-->
<!--    $(document).ready(function () {-->
<!--        count = 1;-->
<!--        setInterval(function () {-->
<!--            if (count == 2) {-->
<!--                $('.desc').css('color', 'green');-->
<!--                count = 3;-->
<!--            }-->
<!--            else if (count == 1) {-->
<!--                $('.desc').css('color', 'red');-->
<!--                count = 2;-->
<!--            }-->
<!--            else if (count == 3) {-->
<!--                $('.desc').css('color', 'blue');-->
<!--                count = 1;-->
<!--            }-->
<!--        }, 1500);-->
<!---->
<!---->
<!--    });-->
<!--</script>-->
<!---->
<!--<form>-->
<!--    <label>Мужчина</label>-->
<!--    <input type="radio" name="pol" value="1">-->
<!--    <label>Женщина</label>-->
<!--    <input type="radio" name="pol" value="2">-->
<!--    <span id="error"></span>-->
<!--    <input type="text" name="login">-->
<!--    <input type="submit" id="otpr" value="Отправить">-->
<!--</form>-->
<!--<script type="text/javascript">-->
<!--    $(document).ready(function () {-->
<!--        $('#otpr').click(function () {-->
<!--            var login = $('input[name="login"]').val();-->
<!--            var pol = $('input[name="pol"]:checked').val();-->
<!--            if (login.length >= 4) {-->
<!--                jQuery('#error').html('');-->
<!--            } else {-->
<!--                $('#error').html('<p style="color:red;">Неправильно заполнили имя</p>');-->
<!--            }-->
<!--            if (pol) {-->
<!--                if (pol == 1) {-->
<!--                    alert('Вы мужик!');-->
<!--                } else {-->
<!--                    alert('Вы тетя!');-->
<!--                }-->
<!--            } else {-->
<!--                alert('Выбери пол!');-->
<!--            }-->
<!--            return false;-->
<!--        });-->
<!---->
<!--    });-->
<!--</script>-->
<!---->
<!--<style>-->
<!--    #modal {-->
<!--        border: solid 1px grey;-->
<!--        width: 150px;-->
<!--        padding: 10px;-->
<!--        text-align: center;-->
<!--        position: fixed;-->
<!--        top: 30%;-->
<!--        left: 35%;-->
<!--        background: green;-->
<!--        display: none;-->
<!--    }-->
<!---->
<!--    .over {-->
<!--        background: black;-->
<!--        width: 100%;-->
<!--        height: 100%;-->
<!--        position: fixed;-->
<!--        top: 0;-->
<!--        left: 0;-->
<!--        opacity: 0.6;-->
<!--        display: none;-->
<!---->
<!--    }-->
<!--</style>-->
<!--<div class="over"></div>-->
<!--<div id="modal">-->
<!--    <div>HELLO WORLD!!</div>-->
<!--</div>-->
<!--<div id="qwerty">Вызвать</div>-->
<!---->
<!--<script type="text/javascript">-->
<!---->
<!--    $(document).ready(function () {-->
<!--        $('#qwerty').click(function () {-->
<!--            $('.over').css('display', 'block');-->
<!--            $('#modal').css('display', 'block');-->
<!---->
<!--        });-->
<!--        $('.over').click(function () {-->
<!--            $('.over').css('display', 'none');-->
<!--            $('#modal').css('display', 'none');-->
<!--        });-->
<!--    });-->
<!--</script>-->

<!--<p id="load" style="cursor: pointer;">Загрузка данных</p>-->
<!--<div id="information"></div>-->
<!--<br>-->
<!---->
<!--<script type="text/javascript">-->
<!--    function funcBefore() {-->
<!--        $('#information').text('Load...');-->
<!---->
<!--    }-->
<!---->
<!--    function funcSuccess(data) {-->
<!--        $('#information').text(data);-->
<!---->
<!--    }-->
<!--$(document).ready(function () {-->
<!--    $('#load').bind('click',function () {-->
<!--        var name = 'user';-->
<!--        var pass = '1234';-->
<!--        $.ajax({-->
<!--            url:'content.php',-->
<!--            type:'POST',-->
<!--            data:'name='+name+'&password='+pass,-->
<!--            dataType: 'html',-->
<!--            beforeSend: funcBefore,-->
<!--            success: funcSuccess-->
<!--        });-->
<!--    });-->
<!--});-->
<!--    </script>-->
<!--<br>-->


<label>Укажите страну</label>
<select name="country">
    <option value="0"></option>
    <option value="1">Украина</option>
    <option value="2">Грузия</option>
</select>
<br>

<label>Укажите город</label>
<select name="city">
    <option value="0"></option>
</select>

<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="country"]').bind('change', function () {
            $('select[name="city"]').empty();
            $.ajax({
                url: 'city.php',
                type: 'get',
                data: 'country=' + $('select[name="country"]').val(),
                dataType: 'json',
                success: function (data) {
                    for (var id in data) {
                        $('select[name="city"]').append($('<option value="' + id + '">' + data[id] + '</option>'));
                    }
                }

            });
        });
    });


    //  $(document).ready(function () {
    //     $('select[name="country"]').bind('change',function(){
    //         $('select[name="city"]').empty();
    //         $.get('city.php',({country:$('select[name="country"]').val()}),
    //             function (data) {
    //                 data2=JSON.parse(data);
    //                 data=data2;
    //                 for(var id in data){
    //                     $('select[name="city"]').append($('<option value="'+id+'">'+data[id]+'</option>'));
    //                 }
    //             });
    //     });
    // });


</script>

