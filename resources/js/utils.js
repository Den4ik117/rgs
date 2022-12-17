const idGenerator = (start = 0) => {
    let id = start;

    return () => ++id;
}

export {
    idGenerator
};
