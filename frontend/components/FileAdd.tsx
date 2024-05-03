import React from 'react';
import { Formik, Form, Field, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import { Form as BootstrapForm, FloatingLabel, Button } from 'react-bootstrap';
import useApi from "../hooks/useApi";
import { apiRoutes } from "../config/apiRoutes";
import FlashAlert from "./FlashAlert";
import { t } from '../i18n';

const FileAdd = () => {
    const { post } = useApi();

    const initialValues = {
        image: null,
        name: '',
        email: '',
    };

    const validationSchema = Yup.object().shape({
        image: Yup.mixed().required(t('Please select a file')),
        name: Yup.string().required(t('Please enter your name')),
        email: Yup.string().email(t('Please enter a valid email address')).required(t('Please enter your email address')),
    });

    const handleSubmit = async (values, { setSubmitting, setErrors, setStatus }) => {
        const { image, name, email } = values;

        const params = new FormData();
        params.append('image', image);
        params.append('name', name);
        params.append('email', email);

        try {
            await post(apiRoutes.fileManager, params);
            setStatus({ success: true });
        } catch (error) {
            if (error.response && error.response.status === 400 && error.response.data.errors) {
                const translatedErrors = translateApiErrors(error.response.data.errors);
                setErrors(translatedErrors);
            } else {
                console.error(t('Error sending data'), error);
            }
            setStatus({ success: false });
        }

        setSubmitting(false);
    };

    const translateApiErrors = (errors: string[]) => {
        return errors.reduce((acc, error) => {
            Object.keys(error).forEach(field => {
                const translatedErrors = error[field].map((errorMessage: string) => t(errorMessage));
                acc[field] = translatedErrors.join('. ');
            });
            return acc;
        }, {});
    };

    const alertMessages = {
        success: t('The form was sent correctly'),
        failure: t('An error occurred while processing the request'),
    }

    return (
        <Formik
            initialValues={initialValues}
            validationSchema={validationSchema}
            onSubmit={handleSubmit}
        >
            {({ isSubmitting, status }) => (
                <Form>
                    <FlashAlert status={status} messages={alertMessages}/>
                    <BootstrapForm.Group className="mb-3">
                        <Field name="image">
                            {({ field, form }) => (
                                <input
                                    className="form-control"
                                    type="file"
                                    onChange={(event) => {
                                        form.setFieldValue(field.name, event.currentTarget.files[0]);
                                    }}

                                />
                            )}
                        </Field>
                        <ErrorMessage name="image" component="div" className="text-danger" />
                    </BootstrapForm.Group>

                    <BootstrapForm.Group className="mb-3">
                        <FloatingLabel controlId="name" label="Imię">
                            <Field name="name" type="text" as={BootstrapForm.Control} />
                            <ErrorMessage name="name" component="div" className="text-danger" />
                        </FloatingLabel>
                    </BootstrapForm.Group>

                    <BootstrapForm.Group className="mb-3">
                        <FloatingLabel controlId="email" label="Email">
                            <Field name="email" type="email" as={BootstrapForm.Control} />
                            <ErrorMessage name="email" component="div" className="text-danger" />
                        </FloatingLabel>
                    </BootstrapForm.Group>

                    <div style={{ textAlign: 'right' }}>
                        <Button type="submit" variant="primary" disabled={isSubmitting}>{t('Send')}</Button>
                    </div>
                </Form>
            )}
        </Formik>
    );
};

export default FileAdd;