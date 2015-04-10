describe('Calculator', function() {
    var calculator, stackMock;

    function noop() {}

    beforeEach(function() {
        stackMock = jasmine.createSpyObj('Stack', ['getStack', 'peek', 'push', 'replaceTop', 'pull', 'clear']);

        calculator = new Calculator(stackMock);
    });

    it('creates the expression', function() {
        stackMock.peek.and.returnValue(2);
        stackMock.getStack.and.returnValue([1, '+', 2]);

        expect(calculator.getExpression()).toBe('1 + 2');
    });

    it('removes empty operator from the end of', function() {
        stackMock.getStack.and.returnValue([1, '+', 1, '*']);

        expect(calculator.getExpression()).toBe('1 + 1');
    });

    it('checks if top is a number', function() {
        stackMock.peek.and.returnValue(1);

        expect(calculator.isTopANumber()).toBe(true);

        stackMock.peek.calls.reset();
        stackMock.peek.and.returnValue('+');

        expect(calculator.isTopANumber()).toBe(false);
    });

    it('should add numbers to the expression', function() {
        stackMock.getStack.and.returnValue([1]);
        stackMock.peek.and.returnValue(undefined);

        calculator.addNumber(1);

        expect(stackMock.push).toHaveBeenCalledWith(1);
    });

    it('should concatenate numbers on the expression', function() {
        stackMock.getStack.and.returnValue([12]);
        stackMock.peek.and.returnValue(1);
        stackMock.pull.and.returnValue(1);

        calculator.addNumber(1).addNumber(2);

        expect(stackMock.push).toHaveBeenCalledWith(12);
    });

    it('should add operators to the expression', function() {
        stackMock.getStack.and.returnValue([1, '+', 1]);
        stackMock.peek.and.returnValue(1);

        calculator.addNumber(1).addOperator('+').addNumber(1);

        expect(stackMock.push).toHaveBeenCalledWith('+');
    });

    it('should change operators on top of expression', function() {
        stackMock.getStack.and.returnValue([1, '*', 1]);
        stackMock.peek.and.returnValue('+');

        calculator.addNumber(1).addOperator('+').addOperator('*').addNumber(1);

        expect(stackMock.replaceTop).toHaveBeenCalledWith('*');
    });

    it('should clean the expression', function() {
        calculator.addNumber(1).addNumber(2).clear();

        expect(stackMock.clear).toHaveBeenCalled();
    });

    it('should remove the last added one digit number', function() {
        stackMock.peek.and.returnValue(1);
        calculator.addNumber(1).addOperator('+').addNumber(1);
        calculator.deleteTop();

        expect(stackMock.pull).toHaveBeenCalled();
    });

    it('should remove the last digit of the top number', function() {
        stackMock.peek.and.returnValue(123);
        calculator.addNumber(1).addNumber(2).addNumber(3);
        calculator.deleteTop();

        expect(stackMock.replaceTop).toHaveBeenCalledWith(12);
    });

    it('should remove the last added operation', function() {
        stackMock.peek.and.returnValue('+');
        calculator.addNumber(1).addOperator('+');
        calculator.deleteTop();

        expect(stackMock.pull).toHaveBeenCalled();
    });
});
