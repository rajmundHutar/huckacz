var matchGame = {
    sizeX: 4,
    sizeY: 4,
    timer: false,
    startTime: false
};

matchGame.deck = [];

for (var i = 1; i <= matchGame.sizeX * matchGame.sizeY / 2; i++) {
    matchGame.deck.push(i);
    matchGame.deck.push(i);
}

$(function () {
    matchGame.deck.sort(shuffle);
    for (var i = 1; i < matchGame.sizeX * matchGame.sizeY; i++) {
        $(".card:first-child").clone().appendTo(".cards");
    }

    $(".cards").children().each(function (index) {
        $(this).css({
            "left": ($(this).width() + 20) * (index % matchGame.sizeX),
            "top": ($(this).height() + 20) * Math.floor(index / matchGame.sizeX)
        });

        var pattern = matchGame.deck.pop();

        $(this).find(".back img").attr("src", baseUri + "/images/games/pexeso/" + pattern + ".png");
        $(this).attr("data-pattern", pattern);
        $(this).click(function () {
            startTimer();
            
            if ($(".card-flipped").size() > 1) {
                return;
            }
            $(this).addClass("card-flipped");

            if ($(".card-flipped").size() == 2) {
                setTimeout(checkPattern, 700);
            }
        });
    });
});


function shuffle() {
    return 0.5 - Math.random();
}
function checkPattern() {
    if (isMatch()) {
        $(".card-flipped").removeClass("card-flipped").addClass("card-removed");
        $(".card-removed").bind("webkitTransitionEnd", removeTookCards);
    } else {
        $(".card-flipped").removeClass("card-flipped");
    }
}

function isMatch() {
    var cards = $(".card-flipped");
    var c1 = $(cards[0]).data("pattern");
    var c2 = $(cards[1]).data("pattern");
    return (c1 == c2);
}

function removeTookCards() {
    $(".card-removed").remove();
    isFinish();
}

function isFinish(){
    if ($(".cards .card").length === 0){
        clearInterval(matchGame.timer);
        swal("Výborně", "Tvůj čas: " + $("#game #time").html() + "!", "success");
    }
}

function startTimer(){
    if (matchGame.timer !== false){
        return;
    }    
    matchGame.startTime = (new Date).getTime();
    matchGame.timer = setInterval(function(){
        var time = (new Date).getTime() - matchGame.startTime;
        var date = new Date(time);
        var s = date.getSeconds();
        var m = date.getMinutes();
        var res = (m < 10 ? "0" + m : m) + ":" + (s < 10 ? "0" + s : s) + "." + date.getMilliseconds();
        $("#game #time").html(res);
    }, 10);
}