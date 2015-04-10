(function(global) {
    function isNumber(n) {
        return !isNaN(n);
    }

    function Calculator(stack) {
        this._expression = stack;
    }

    Calculator.prototype.isTopANumber = function() {
        return isNumber(this._expression.peek());
    };

    Calculator.prototype.getExpression = function calculatorGetExpr() {
        var expr = this._expression.getStack();
        if (!this.isTopANumber()) {
            expr = expr.slice(0, -1);
        }

        return expr.join(' ');
    };

    Calculator.prototype.addNumber = function calculatorAddNumber(n) {
        if (this.isTopANumber()) {
            this._expression.push(parseInt("" + this._expression.pull() + n, 10));
        } else {
            this._expression.push(n);
        }

        return this;
    };

    Calculator.prototype.addOperator = function calculatorAddOperator(o) {
        if (this.isTopANumber()) {
            this._expression.push(o);
        } else {
            this._expression.replaceTop(o);
        }

        return this;
    };

    Calculator.prototype.clear = function calculatorClean() {
        this._expression.clear();

        return this;
    };

    Calculator.prototype.deleteTop = function calculatorDeleteTop() {
        var numAsStr;
        if (this.isTopANumber()) {
            numAsStr = ("" + this._expression.peek());
            if (numAsStr.length === 1) {
                this._expression.pull();
            } else {
                this._expression.replaceTop(parseInt(numAsStr.substr(0, numAsStr.length - 1), 10));
            }
        } else {
            this._expression.pull();
        }
    };

    global.Calculator = Calculator;
}(window));
