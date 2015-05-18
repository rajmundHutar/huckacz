var Point = function (poz_x, poz_y) {
    this.x = parseInt(poz_x);
    this.y = parseInt(poz_y);
    
    this.equals = function(point){
        if (!point instanceof Point){
            throw new "You have to compare Points";
        }
        if (point.x === this.x && point.y === this.y){
            return true;
        }
        return false;
    };
    
    this.inBoundaries = function(x1, y1, x2, y2){
        if (this.x < x1 || this.x > x2){
            return false;
        }
        if (this.y < y1 || this.y > y2){
            return false;
        }
        return true;
    };
};

var PATNACTKA = {
    shuffling: false,
    end: true,
    started: false,
    timer: false,
    empty: new Point(3, 3),
    width: 4,
    height: 4,
    moveTime: 300
};


$(document).ready(function () {
    var card = $("#game img.card");
    for (var i = 1; i < PATNACTKA.width * PATNACTKA.height - 1; i++) {

        var newCard = card.clone();
        var point = new Point(i % PATNACTKA.width, Math.floor(i / PATNACTKA.height));
        newCard.attr("data-position", point.x + "-" + point.y);
        newCard.attr("src", basePath + "/images/games/fifteen/" + (i < 10 ? "0" + i : i) + ".jpg");
        newCard.css({
            top: point.y * 100 + "px",
            left: point.x * 100 + "px"
        });
        $("#game").append(newCard);
    }

    $("#shuffle").click(function () {
        clearTimeout(PATNACTKA.timer);
        shuffle();
    });
    $("#game").on("click", "img.card", function (e) {
        e.preventDefault();
        var position = $(this).attr("data-position");
        move(new Point(position.split("-")[0], position.split("-")[1]));
    });

    $(document).keydown(function (e) {
        if (e.keyCode < 37 || e.keyCode > 40) {
            return;
        }
        e.preventDefault();
        //LEVA
        if (e.keyCode === 37) {
            move(new Point(PATNACTKA.empty.x + 1, PATNACTKA.empty.y));
        }
        //PRAVA
        if (e.keyCode === 39) {
            move(new Point(PATNACTKA.empty.x - 1, PATNACTKA.empty.y));
        }
        //NAHORU
        if (e.keyCode === 38) {
            move(new Point(PATNACTKA.empty.x, PATNACTKA.empty.y + 1));
        }
        //DOLU
        if (e.keyCode === 40) {
            move(new Point(PATNACTKA.empty.x, PATNACTKA.empty.y - 1));
        }
        return false;
    });
});
function move(poz) {
    if (poz.x < 0 || poz.y < 0 || poz.x >= PATNACTKA.width || poz.y >= PATNACTKA.height) {
        return;
    }
    if (PATNACTKA.end) {
        return;
    }
    if (!PATNACTKA.started && !PATNACTKA.shuffling) {
        startTime();
        PATNACTKA.started = true;
    }

    if (poz.x === PATNACTKA.empty.x) {
        if (poz.y < PATNACTKA.empty.y) {
            for (var i = PATNACTKA.empty.y - 1; i >= poz.y; i--) {
                $("#game img.card[data-position=" + poz.x + "-" + i + "]").animate({
                    top: '+=100'
                }, PATNACTKA.moveTime, function () {
                    check_end(poz.x, poz.y);
                });
                $("#game img.card[data-position=" + poz.x + "-" + i + "]").attr("data-position", poz.x + "-" + (i + 1));
            }
        }
        else {
            for (var i = (PATNACTKA.empty.y + 1); i <= poz.y; i++) {
                $("#game img.card[data-position=" + poz.x + "-" + i + "]").animate({
                    top: '-=100'
                }, PATNACTKA.moveTime, function () {
                    check_end(poz.x, poz.y);
                });
                $("#game img.card[data-position=" + poz.x + "-" + i + "]").attr("data-position", poz.x + "-" + (i - 1));
            }
        }
        PATNACTKA.empty = poz;
    }
    else if (poz.y === PATNACTKA.empty.y) {
        if (poz.x < PATNACTKA.empty.x) {
            for (var i = PATNACTKA.empty.x - 1; i >= poz.x; i--) {
                //alert($("IMG[name="+i+"-"+y+"]").attr("src"));

                $("#game img.card[data-position=" + i + "-" + poz.y + "]").animate({
                    left: '+=100'
                }, PATNACTKA.moveTime, function () {
                    check_end(poz.x, poz.y);
                });
                $("#game img.card[data-position=" + i + "-" + poz.y + "]").attr("data-position", (i + 1) + "-" + poz.y);
            }
        }
        else {
            for (var i = PATNACTKA.empty.x + 1; i <= poz.x; i++) {
                $("#game img.card[data-position=" + i + "-" + poz.y + "]").animate({
                    left: '-=100'
                }, PATNACTKA.moveTime, function () {
                    check_end(poz.x, poz.y);
                });
                $("#game img.card[data-position=" + i + "-" + poz.y + "]").attr("data-position", (i - 1) + "-" + poz.y);
            }
        }

        PATNACTKA.empty = poz;
    }
}


function check_end(x, y) {
    if (x == (PATNACTKA.width - 1) && y == (PATNACTKA.height - 1) && PATNACTKA.started == true) {
        var chyba = false;
        for (var j = 0; j < PATNACTKA.height; j++) {
            for (var i = 0; i < PATNACTKA.width; i++) {
                var num;
                var src;
                if (i != x || j != y) {
                    num = ((j * (PATNACTKA.width) + i) < 10) ? "0" + (j * (PATNACTKA.width) + i) : (j * (PATNACTKA.width) + i);
                    var tmp = $("IMG[data-position=" + i + "-" + j + "]").attr("src");
                    if (tmp != undefined) {//pokud hrajes moc rychle tk to tu hodi chybu
                        var src_arr = tmp.split("/");
                        src = src_arr[src_arr.length - 1];
                        if (num + ".jpg" != src)
                            chyba = true;
                    }
                }
            }
        }
        if (chyba === false) {
            PATNACTKA.end = true;
            clearTimeout(PATNACTKA.timer);
            swal("Výborně", "Tvůj čas: " + $("SPAN#time").html(), "success");
        }
    }
}
function shuffle() {
    PATNACTKA.shuffling = true;
    PATNACTKA.end = false;
    PATNACTKA.started = false;
    PATNACTKA.moveTime = 50;
    $("SPAN#time").html("00:00:00");
    shuffleStep(0, 100, new Point(5, 5), new Point(5, 5));
}

function shuffleStep(counter, maxShuffle, lastPoint, preLastPoint) {
    do{
        var movePoint = new Point((Math.floor(Math.random() * 3)) - 1, (Math.floor(Math.random() * 3)) - 1);
        var point = new Point(PATNACTKA.empty.x + movePoint.x, PATNACTKA.empty.y + movePoint.y);
    } while(point.equals(lastPoint) 
            || point.equals(preLastPoint)
            || movePoint.equals(new Point(0,0))
            || movePoint.equals(new Point(1,1))
            || movePoint.equals(new Point(-1,1))
            || movePoint.equals(new Point(1,-1))
            || movePoint.equals(new Point(-1,-1))
            || !point.inBoundaries(0,0, PATNACTKA.width - 1, PATNACTKA.height - 1));
    move(point);
    if (counter < maxShuffle) {
        setTimeout(function () {
            shuffleStep(counter + 1, maxShuffle, point, lastPoint);
        }, 50);
    } else {
        PATNACTKA.moveTime = 300;
        PATNACTKA.shuffling = false;
    }
}

function startTime() {
    PATNACTKA.startTime = (new Date()).getTime();
    PATNACTKA.timer = setInterval(function() {
        var time = (new Date).getTime() - PATNACTKA.startTime;
        var date = new Date(time);
        var s = date.getSeconds();
        var m = date.getMinutes();
        $("SPAN#time").html((m < 10 ? "0" + m : m) + ":" + (s < 10 ? "0" + s : s) + "." + date.getMilliseconds());
    }, 10);
}

        