$(document).ready(function () {
    var body = $('body');
    var dark = $('.dark');
    var modal = $('.modal');

    function returnVisibleBackground() {
        dark.fadeOut();
        body.css("overflow", "visible");
    }

    setTimeout(function () {
        body.css("overflow", "hidden");
        dark.fadeIn();
        var dropDown = $(".dropdown");
        var wrapperDropdown = $('.wrapper-dropdown');
        var dropDownA = $('.dropdown a');
        var defaultCategory = $('.dropdown a[data-value="B"]');

        wrapperDropdown.html(defaultCategory.html());
        wrapperDropdown.attr('data-value', defaultCategory.attr('data-value'));

        wrapperDropdown.on('click', function (event) {
            event.stopPropagation();
            dropDown.toggleClass('hide');
        });

        dark.on('click', function (event) {
            event.stopPropagation();
            returnVisibleBackground();
        });

        dropDownA.on("click", function () {
            wrapperDropdown.html($(this).html());
            wrapperDropdown.attr('data-value', $(this).attr('data-value'));
        });

        modal.on('click', function (event) {
            event.stopPropagation();
            dropDown.addClass('hide');
        });

        $("form input[type='submit']").on("click", function (evt) {
            evt.preventDefault();
            var name = $('input[type="text"]').val();
            var category = wrapperDropdown.attr('data-value');
            if (name.length >= 2 && category !== null) {
                var data = {
                    "name": name,
                    "category": category
                }
                $.post('/handler.php', data, function (data) {
                    if (data === "success") {
                        alert("Данные успешно добавлены");
                        returnVisibleBackground();
                    } else if (data === "error") {
                        alert("Что-то пошло не так"); // можно сделать вывод ошибки для каждого конкретного случая
                    }
                });
            } else if (name.length < 2) {
                alert("Имя должно содержать 2 или более символов");
            }
        });
    }, 5000);
});



