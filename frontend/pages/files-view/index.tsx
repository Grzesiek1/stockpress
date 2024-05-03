import FilesView from "../../components/FilesView";
import React from "react";
import {t} from "../../i18n";

const FileView = () => {
    return (
        <div className="container">
            <div className="row">
                <div className="col-md-8">
                    <h4>{t('File list')}</h4>
                    <FilesView/>
                </div>
            </div>
        </div>
    );
}

export default FileView;