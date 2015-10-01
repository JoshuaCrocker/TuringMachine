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

        this.drawTape();

        this.$state = document.getElementById("state");
        this.$head = document.getElementById("head");
        this.$initial_tape = document.getElementById("initial_tape");
        this.$program = document.getElementById("program");

        this.$state.value = this.state;
        this.$head.value = this.hpos;
        this.$initial_tape.value = this.tape.join('');
    });

    TuringMachine.prototype.getCell = (function (cell) {
        return this.tape[cell];
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

        this.$head.value = this.hpos;
    });

    TuringMachine.prototype.addRule = (function (state, input, new_state, output, movement) {
        if (!this.rules[state]) this.rules[state] = {};
        this.rules[state][input] = [new_state, output, movement];
    });

    TuringMachine.prototype.run = (function () {
        while (this.step()) {

        }
    });

    TuringMachine.prototype.step = (function () {
        if (document.getElementsByClassName('highlight').length) document.getElementsByClassName('highlight')[0].className = '';
        var input = this.getCell(this.hpos);

        if (!this.rules[this.state] || !this.rules[this.state][input]) {
            clearInterval(this.int);
            return false;
        }

        var r = this.rules[this.state][input];

        this.state = r[0];
        this.setCell(this.hpos, r[1]);
        this.moveHead(r[2]);

        console.log(this.tape);

        this.drawTape();

        this.$state.value = this.state;

        document.getElementById(this.state + '_' + input).className = 'highlight';

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



