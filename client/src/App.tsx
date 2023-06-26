import React, {useEffect, useState} from 'react';
import './App.css';
import UnitList from "./components/unitList";
import {UnitType} from "./types/UnitType";

const App = () => {
    const [data, setData] = useState<UnitType[]>([]);

    const loadData = () => {
        fetch(`http://localhost/api/node/childs/0`)
            .then((response) => response.json())
            .then((actualData) => setData(actualData));
    }

    useEffect(() => {
        loadData()
    }, []);

    return (
        <>
            <UnitList
                data={data}
                handlerData={loadData}
                parentId={0}
            />
        </>
    );
}

export default App;
