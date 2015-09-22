/*
 _ denotes blank
 Any other symbol can be used

 ST is terminating state
 */

(function () {
    var TuringMachine = (function (elem, tape, state, hpos) {
        this.elem = elem;
        this.tape = tape || [];
        this.state = state || 'S0';
        this.hpos = hpos || 0;

        this.int = -1;

        this.rules = {};
    });

    TuringMachine.prototype.getCell = (function (cell) {
        return this.tape[cell] || false;
    });

    TuringMachine.prototype.setCell = (function (cell, value) {
        this.tape[cell] = value;
    });

    TuringMachine.prototype.moveHead = (function (dir) {
        if (dir == 'l') {
            this.hpos--;
        } else if (dir == 'r') {
            this.hpos++;
        } else {
            return false;
        }

        if (this.hpos < 0) {
            this.tape.unshift('_');
        }

        if (this.hpos >= this.tape.length) {
            this.tape.push('_');
        }
    });

    TuringMachine.prototype.addRule = (function (state, input, new_state, output, movement) {
        if (!this.rules[state]) this.rules[state] = {};
        this.rules[state][input] = [new_state, output, movement];
    });

    TuringMachine.prototype.run = (function () {
        while (this.step()) {
            //this.sleep(1000);
        }
    });

    TuringMachine.prototype.step = (function () {
        var input = this.tape[this.hpos];

        if (!this.rules[this.state] || !this.rules[this.state][input]) {
            clearInterval(this.int);
            return false;
        }

        var r = this.rules[this.state][input];

        this.state = r[0];
        this.tape[this.hpos] = r[1];
        this.moveHead(r[2]);

        console.log(this.tape);

        this.drawTape();

        return true;
    });

    TuringMachine.prototype.sleep = (function (miliseconds) {
        var currentTime = new Date().getTime();

        while (currentTime + miliseconds >= new Date().getTime()) {
        }
    });

    TuringMachine.prototype.drawTape = (function () {
        // Empty element
        while (this.elem.hasChildNodes()) {
            this.elem.removeChild(this.elem.lastChild);
        }

        // Add stuffs
        for (var cell_ref in this.tape) {
            var cell = this.tape[cell_ref];

            var e = document.createElement('li');
            if (cell_ref == this.hpos) e.className = 'head';
            e.innerHTML = cell;
            this.elem.appendChild(e);
        }

    });

    window.TuringMachine = TuringMachine;
})();

var elem = document.getElementById('tape');
var tape = [1, 0, 1];
var TM = new TuringMachine(elem, tape);

// EVEN PARITY
TM.addRule('S0', 0, 'Se', 0, 'r');
TM.addRule('S0', 1, 'So', 1, 'r');
TM.addRule('S0', '_', 'S0', '_', 'r');

TM.addRule('Se', 0, 'Se', 0, 'r');
TM.addRule('Se', 1, 'So', 1, 'r');
TM.addRule('Se', '_', 'ST', 0, 'r');

TM.addRule('So', 0, 'So', 0, 'r');
TM.addRule('So', 1, 'Se', 1, 'r');
TM.addRule('So', '_', 'ST', 1, 'r');

console.log(TM.rules);
