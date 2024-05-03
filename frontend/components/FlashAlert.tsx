import {Alert} from "react-bootstrap";
import React, {useEffect, useState} from "react";

const FlashAlert = ({status, messages}) => {
    const [isVisible, setIsVisible] = useState(true);

    useEffect(() => {
        setIsVisible(true);
        const timeout = setTimeout(() => setIsVisible(false), 3000);
        return () => clearTimeout(timeout);
    }, [status]);

    return isVisible && (
        <>
            {status && status.success === false && (
                <Alert variant="danger">
                    <div style={{textAlign: 'center'}}>
                        {messages.failure}
                    </div>
                </Alert>
            )}

            {status && status.success === true && (
                <Alert variant="success">
                    <div style={{textAlign: 'center'}}>
                        {messages.success}
                    </div>
                </Alert>
            )}
        </>
    )
}

export default FlashAlert;