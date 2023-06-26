import React, {useState} from 'react';

import Button from 'react-bootstrap/Button';
import Modal from 'react-bootstrap/Modal';
import Form from 'react-bootstrap/Form';

type props = {
    callback: Function,
    parentId: number
}

const UnitChildAdd: React.FC<props> = (props: props) => {
    const [show, setShow] = useState(false);
    const [unitName, setUnitName] = useState("")

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const handleUnitName = (e: React.ChangeEvent<HTMLInputElement>) => setUnitName(e.target.value)

    const handleSubmit = () => {
        const data = new FormData();
        data.append("name", unitName);
        data.append('parentId', String(props.parentId))

        fetch(
            'http://localhost/api/node',
            {
                method: 'POST',
                mode: 'no-cors',
                body: data
            }
        ).then(() => {
            setUnitName("");
            props.callback();
            handleClose();
        })
    }
    return (
        <>
            <Button variant="primary" onClick={handleShow}>
                New Unit
            </Button>

            <Modal show={show} onHide={handleClose}>
                <Modal.Header closeButton>
                    <Modal.Title>Modal heading</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <Form>
                        <Form.Group className="mb-3" controlId="formBasicEmail">
                            <Form.Label>Unit name</Form.Label>
                            <Form.Control type="text"
                                          placeholder="Name"
                                          value={unitName}
                                          onChange={handleUnitName}
                            />
                        </Form.Group>
                    </Form>
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="secondary" onClick={handleClose}>
                        Close
                    </Button>
                    <Button variant="primary" onClick={handleSubmit}>
                        Add
                    </Button>
                </Modal.Footer>
            </Modal>
        </>
    )
};

export default UnitChildAdd;
