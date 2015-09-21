(function () {
    var TuringMachine = (function (elem, tape, state, hpos) {
        this.elem = elem;
        this.tape = tape || [];
        this.state = state || 'S0';
        this.hpos = hpos || 0;
    });

    TuringMachine.prototype.getCell = (function (cell) {
        return this.tape[cell] || false;
    });

    TuringMachine.prototype.setCell = (function (cell, value) {
        this.tape[cell] = value;
    });

    window.TuringMachine = TuringMachine;
})();

var elem = document.getElementById('tape');
var tape = ['_', 1, 0, 1];
var TM = new TuringMachine(elem, tape);


