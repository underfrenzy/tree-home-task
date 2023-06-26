import React from 'react';

import ListGroup from 'react-bootstrap/ListGroup';
import Row from "react-bootstrap/Row";
import Tab from 'react-bootstrap/Tab';
import Col from "react-bootstrap/Col";
import Container from "react-bootstrap/Container";

import {UnitType} from "../../types/UnitType";
import UnitChildAdd from "../unitChild/add";

type props = {
    data: UnitType[],
    parentId: number,
    handlerData: Function
}

const UnitList: React.FC<props> = (props: props) => {
    return (
        <Container className="m-4">
            <Row>
                <Col>
                    <div className="mb-2">
                        <UnitChildAdd
                            callback={props.handlerData}
                            parentId={props.parentId}
                        />
                    </div>
                    <Tab.Container id="list-group-tabs-example" defaultActiveKey="#link1">
                        <Row>
                            <Col sm={4}>
                                <ListGroup>
                                    {props.data.map((unit) =>
                                        (
                                            <ListGroup.Item action href={`#link${unit.id}`}>
                                                {unit.name}
                                            </ListGroup.Item>
                                        )
                                    )}
                                </ListGroup>
                            </Col>
                            <Col sm={8}>
                                <Tab.Content>
                                    {props.data.map((unit) =>
                                        (
                                            <Tab.Pane eventKey={`#link${unit.id}`}>
                                                <UnitList
                                                    data={unit.childs}
                                                    handlerData={props.handlerData}
                                                    parentId={unit.id}
                                                />
                                            </Tab.Pane>
                                        )
                                    )}
                                </Tab.Content>
                            </Col>
                        </Row>
                    </Tab.Container>
                </Col>
            </Row>
        </Container>
    )
};

UnitList.defaultProps = {
    data: [],
    parentId: 0,
}

export default UnitList;
