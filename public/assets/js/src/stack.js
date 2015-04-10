(function(global) {
    function Stack() {
        this._elements = [];
    }

    Stack.prototype.push = function stackPush(element) {
        this._elements.push(element);

        return this;
    };

    Stack.prototype.pull = function stackPull() {
        return this._elements.pop();
    };

    Stack.prototype.replaceTop = function stackReplace(element) {
        this.pull();
        this.push(element);

        return this;
    };

    Stack.prototype.peek = function stackPeek() {
        if (this._elements.length === 0) {
            return undefined;
        }

        return this._elements[this._elements.length - 1];
    };

    Stack.prototype.getStack = function stackGetStack() {
        return this._elements;
    };

    Stack.prototype.clear = function stackClean() {
        this._elements = [];
    };

    global.Stack = Stack;
}(window))
