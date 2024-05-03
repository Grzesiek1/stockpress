import { useEffect, useState } from 'react';

export const useInfinityPagination = () => {
    const [currentPage, setCurrentPage] = useState(1);
    const [maxPages, setMaxPages] = useState(1);

    useEffect(() => {
        window.addEventListener('scroll', handleScroll);

        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    let isScrolling = false;

    const handleScroll = () => {
        if (!isScrolling) {
            isScrolling = true;
            setTimeout(() => {
                if (window.scrollY + window.innerHeight >= document.documentElement.scrollHeight) {
                    setCurrentPage((prevPage) => prevPage + 1);
                }
                isScrolling = false;
            }, 100);
        }
    };

    return { currentPage, maxPages, setMaxPages };
};