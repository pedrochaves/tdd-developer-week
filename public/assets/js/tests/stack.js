describe('Stack', function() {
    var stack;

    beforeEach(function() {
        stack = new Stack();
    });

    it('should initialize with an empty stack', function() {
        expect(stack.getStack()).toEqual([]);
    });

    it('should push elements to stack', function() {
        stack.push(1).push(2).push(3);

        expect(stack.getStack()).toEqual([1, 2, 3]);
    });

    it('should pull elements from stack', function() {
        var pulled, stack = new Stack();

        stack.push(1).push(2).push(3);

        pulled = stack.pull();

        expect(pulled).toBe(3);
        expect(stack.getStack()).toEqual([1, 2]);
    });

    it('should replace elements in stack', function() {
        stack.push(1).push(2).push(3);
        stack.replaceTop(4);

        expect(stack.getStack()).toEqual([1, 2, 4]);
    });

    it('should return undefined on peeking empty list', function() {
        expect(stack.peek()).not.toBeDefined();
    });

    it('should peek top of the list without pulling element', function() {
        stack.push(1).push(2);

        expect(stack.peek()).toBe(2);
        expect(stack.getStack()).toEqual([1, 2]);
    });

    it('should clean the stack', function() {
        stack.push(1).push(2).push(3);

        stack.clear();

        expect(stack.getStack()).toEqual([]);
    })
});
