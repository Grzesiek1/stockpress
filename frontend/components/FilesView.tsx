import {Button, Table} from "react-bootstrap";
import React, {useEffect, useState} from "react";
import {useInfinityPagination} from "../hooks/useInfinityPagination";
import useApi from "../hooks/useApi";
import {apiRoutes} from "../config/apiRoutes";
import {t} from "../i18n";

const FilesView = () => {
    const [filesList, setFilesList] = useState([]);
    const {currentPage, maxPages, setMaxPages} = useInfinityPagination();
    const {get, remove, download} = useApi();

    useEffect(() => {
        getFilesList();
    }, [currentPage]);

    const getFilesList = async () => {
        if (!maxPages || currentPage <= maxPages) {
            let apiFilesList = await get(apiRoutes.fileManager, currentPage)
            setFilesList([...filesList, ...apiFilesList.data.data]);
            setMaxPages(apiFilesList.data.last_page)
        }
    }

    const handleRemove = async (id: number) => {
        await remove(apiRoutes.fileManager, id);
        setFilesList(filesList.filter(file => file.id !== id));
    }

    const handleDownload = async (url: string, fileName: string) => {
        await download(url, fileName);
    }

    return (
        <div className="table-container">
            <Table>
                <thead>
                <tr>
                    <th>{t('Id')}</th>
                    <th>{t('Image')}</th>
                    <th>{t('Name')}</th>
                    <th>{t('Size')}</th>
                    <th>{t('Resolution')}</th>
                    <th>{t('Temperature')}</th>
                    <th>{t('Name of sender')}</th>
                    <th>{t('Email of sender')}</th>
                    <th>{t('Operations')}</th>
                </tr>
                </thead>
                <tbody>
                {filesList.map((file) => (
                    <tr key={file.id}>
                        <td>{file.id}</td>
                        <td><img src={file.thumbnails_url} alt={file.name}/></td>
                        <td>{file.name}</td>
                        <td>{file.size}</td>
                        <td>{file.resolution}</td>
                        <td>{file.temperature}</td>
                        <td>{file.sender_name}</td>
                        <td>{file.sender_email}</td>
                        <td>
                            <tr>
                                <td>
                                    <Button variant="primary" onClick={() => handleRemove(file.id)}>{t('Remove')}</Button>
                                </td>
                                <td>
                                    <Button variant="primary"
                                            onClick={() => handleDownload(file.image_url, file.name)}>{t('Download')}</Button>
                                </td>
                            </tr>
                        </td>
                    </tr>
                ))}
                </tbody>
            </Table>
        </div>
    )
};

export default FilesView;