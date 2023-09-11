import React from "react";

const Pagination = ({currentPage, itemsPerPage, length, onPageChanged, size}) => {
    const pagesCount = Math.ceil(length / itemsPerPage);
    let pages = [];
    const start = (currentPage * itemsPerPage - itemsPerPage) + 1;
    const end = start - 1 + itemsPerPage;

    const taille = size ? size : "pagination-xl"

    if(pagesCount > 10) {
        const array1 = [1, 2, 3, 4]
        const array2 = [pagesCount-3, pagesCount-2, pagesCount-1, pagesCount]
        if(array1.includes(currentPage)){
            pages = [1, 2, 3, 4, 'XX1', pagesCount-1, pagesCount]
        } else if (array2.includes(currentPage)) {
            pages = [1, 2, 'XX1', pagesCount-3, pagesCount-2, pagesCount-1, pagesCount]
        } else {
            pages = [1, 2, 'XX1', currentPage-1, currentPage, currentPage+1, 'XX2', pagesCount-1, pagesCount]
        }
    } else {
        for(let i = 1; i <= pagesCount; i++) {
            pages.push(i)
        }
    }

    return (
        <div className="w-full text-center mt-5">
            <nav aria-label="Pagination">
                <ul className="inline-flex -space-x-px">
                    <li>
                        {currentPage === 1 ?
                            <button className="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 ml-0 rounded-l-lg leading-tight py-2 px-3"
                                    disabled="disabled">&laquo;</button>
                            :
                            <button onClick={() => onPageChanged(currentPage - 1)}
                                    className="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 ml-0 rounded-l-lg leading-tight py-2 px-3">&laquo;</button>
                        }
                    </li>

                    {pages.map(page => {
                        if(page === 'XX1' || page === 'XX2'){
                            return (
                                <li key={page} className={"page-item disabled"}>
                                    <button className="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3">...</button>
                                </li>
                            )
                        }
                        return (
                            <li key={page}>
                                {currentPage === page ?
                                    <button className="bg-blue-50 border border-gray-300 text-blue-600 hover:bg-blue-100 hover:text-blue-700 leading-tight py-2 px-3"
                                            disabled="disabled">{page}</button>
                                    :
                                    <button className="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3" onClick={() => onPageChanged(page)}>{page}</button>
                                }
                            </li>
                        )
                    })}

                    <li>
                        {currentPage === pagesCount ?
                            <button className="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 rounded-r-lg leading-tight py-2 px-3"
                                    disabled="disabled">&raquo;</button>
                            :
                            <button onClick={() => onPageChanged(currentPage + 1)}
                                    className="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 rounded-r-lg leading-tight py-2 px-3">&raquo;</button>
                        }
                    </li>
                </ul>
            </nav>
        </div>
    );
};

Pagination.getData = (items, currentPage, itemsPerPage) => {
    const start = currentPage * itemsPerPage - itemsPerPage;
    return items.slice(start, start + itemsPerPage);
}

export default Pagination;