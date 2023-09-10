import React, {useEffect, useState} from 'react';
import {createRoot} from "react-dom/client";
import CardLoader from "../components/CardLoader";
import fetchApi from "../services/fetchApi";
import LinkCard from "../components/LinkCard";
import SelectOption from "../components/SelectOption";
import Pagination from "../components/Pagination";

const Search = () => {
    const [datas, setDatas] = useState([]);
    const [loading, setLoading] = useState(true);

    const [affCard, setAffCard] = useState(true);
    const [filteredDatas, setFilteredDatas] = useState([]);
    const [search, setSearch] = useState({word: '', category: '', tags: '', author: '', language: ''});
    const [currentPage, setCurrentPage] = useState(1);
    const [itemsPerPage, setitemsPerPage] = useState(parseInt('25'))

    useEffect(() => {
        fetchDatas()
    }, []);

    useEffect(() => {
// console.log('search', search)
        setFilteredDatas(datas.filter(
            r =>
                (
                    r.title.toString().toLowerCase().includes(search.word.toLowerCase())
                    ||
                    r.description.toString().toLowerCase().includes(search.word.toLowerCase())
                )
                &&
                r.category.codeCategory.code.toString().toLowerCase().includes(search.category.toLowerCase())
                &&
                r.language.shortname.toString().toLowerCase().includes(search.language.toLowerCase())
                &&
                r.tags.filter(t => t.title.toString().toLowerCase().includes(search.tags.toString().toLowerCase())).length > 0
        ))
    }, [search])

    const fetchDatas = async () => {
        try{
            const tutos = await fetchApi.getTutos();
            setDatas(tutos);
            setFilteredDatas(tutos);

            setLoading(false);
        } catch( error ) {
            console.error(error)
        }
    }

    const handlePageChange = (page) => {
        setCurrentPage(page);
    }

    const handleChange = (e) => {
        const currentTarget = e.currentTarget
        const {name, value} = currentTarget

        setCurrentPage(1);

        setSearch({...search, [name] : value})
    }

    const handleChangeAff = () => {
        setAffCard(!affCard)
    }

    const handleReset = () => {
        setFilteredDatas(datas)
        setSearch({word: '', category: '', tags: '', author: '', language: ''})
    }

    const paginated = Pagination.getData(filteredDatas, currentPage, itemsPerPage);

    return (
        <div className="flex flex-col md:flex-row gap-6">
            <div className="mb-2 md:basis-1/4">
                <div className="form-control w-full">
                    <label className="label" htmlFor="f_search">
                        <span className="label-text">Recherche</span>
                    </label>
                    <input type="text"
                           id="f_search"
                           name="word"
                           onChange={handleChange}
                           value={search.word}
                           placeholder="Recherche par mot-clé"
                           className="input input-bordered input-sm w-full"/>
                </div>

                <SelectOption
                    id={'f_category'}
                    name={'category'}
                    label={'Catégorie'}
                    handleChange={handleChange}
                    selectedValue={search.category}
                    endpoint={'categories'}
                ></SelectOption>

                <SelectOption
                    id={'f_language'}
                    name={'language'}
                    label={'Langue'}
                    handleChange={handleChange}
                    selectedValue={search.language.shortname}
                    endpoint={'languages'}
                ></SelectOption>

                {/*<SelectMultiple*/}
                {/*    id={'f_language'}*/}
                {/*    name={'language'}*/}
                {/*    label={'Langue'}*/}
                {/*    handleChange={handleChange}*/}
                {/*    selectedValue={search.language}*/}
                {/*    endpoint={'languages'}*/}
                {/*></SelectMultiple>*/}

                <div className="form-control w-full">
                    <label className="label" htmlFor="f_search">
                        <span className="label-text">Tags</span>
                    </label>
                    <input type="text"
                           id="f_tags"
                           name="tags"
                           onChange={handleChange}
                           value={search.tags}
                           placeholder=""
                           className="input input-bordered input-sm w-full"
                    />
                </div>


                <button className="btn btn-ghost btn-xs mt-3" onClick={handleReset}>Réinitialiser</button>
            </div>

            <div className="md:basis-3/4">
                <div className="shop-aff w-full">
                    <div className="mb-7 w-full">
                        <div className="text-end mb-2">
                            <button className="btn btn-primary btn-sm" onClick={handleChangeAff}>
                                <i className="fa-solid fa-list"></i>
                            </button>
                        </div>
                        <div className="border-b border-slate-300 w-full"></div>
                    </div>

                    <div
                        className={affCard ? "grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6 place-items-stretch" : "flex flex-col gap-6"}>
                        {loading && <CardLoader/>}
                        {!loading && <>
                            {/*{filteredDatas.length === 0 && <p>Aucun résultat</p>}*/}
                            {/*{filteredDatas.length > 0 && filteredDatas.map(tuto =>*/}
                            {/*    <LinkCard key={tuto.id} tuto={tuto} affCard={affCard} />*/}
                            {/*)}*/}

                            {paginated.length === 0 && <p>Aucun résultat</p>}
                            {paginated.length > 0 && paginated.map(tuto =>
                                <LinkCard key={tuto.id} tuto={tuto} affCard={affCard} />
                            )}
                        </>}
                    </div>
                </div>

                {itemsPerPage < filteredDatas.length &&
                    <Pagination currentPage={currentPage}
                                itemsPerPage={itemsPerPage}
                                length={filteredDatas.length}
                                onPageChanged={handlePageChange}
                    />
                }
            </div>
        </div>
    );
};

class SearchElement extends HTMLElement {
    connectedCallback () {
        const root = createRoot(this);
        root.render(<Search />);
    }
}

customElements.define('react-search', SearchElement);