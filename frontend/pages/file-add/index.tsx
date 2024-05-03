import React from 'react';
import FileAdd from "../../components/FileAdd";
import {t} from "../../i18n";

const FilesList = () => {
    return (
        <>
            <div className="container">
                <div className="row">
                    <div className="col-md-4">
                    </div>
                    <div className="col-md-4">
                        <h4>{t('Adding files')}</h4>
                        <FileAdd />
                    </div>
                    <div className="col-md-4">
                    </div>
                </div>
            </div>
        </>
    );
};

export default FilesList;
