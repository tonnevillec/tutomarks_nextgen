import React from 'react';

const LinkCard = ({tuto, affCard}) => {

    return (
        <div className={affCard ?
                "card bg-base-100 shadow-md"
                : "card bg-base-100 shadow-md card-side w-full"}
             data-theme="tutomarks">
            <a href={ tuto.url }
               target="_blank"
               className={affCard ?
                   "rounded-tl-box rounded-tr-box w-full inline-block cursor-pointer overflow-hidden"
                   : "rounded-tl-box rounded-bl-box max-w-[20%] w-full inline-block cursor-pointer overflow-hidden"}
            >
                <img src={ tuto.img_large ? tuto.img_large : tuto.image ? `/uploads/images/${tuto.image}` : `/uploads/images/${tuto.category.image}` }
                     className={affCard ?
                         "rounded-tl-box rounded-tr-box hover:scale-125 transition duration-500 w-full h-auto"
                         : "rounded-tl-box rounded-bl-box hover:scale-125 transition duration-500 w-full h-auto"}
                     alt={ tuto.title }
                />
            </a>
            <div className="card-body">
                <h3 className="card-title text-base">
                    <a href={ tuto.url } target="_blank" className="hover:text-secondary">{ tuto.title }</a>
                </h3>

                <div className="avatar flex flex-row items-center gap-2">
                    <div className="w-10 rounded-full">
                        <img alt={"Avatar de la chaine " + tuto.author.title } src={ tuto.author.logo } />
                    </div>

                    <a href="#" className="hover:text-secondary">{ tuto.author.title }</a>
                </div>
            </div>

            <div className="card-footer">
                <div className="card-actions justify-end">
                    <div className="badge text-xs badge-primary">{ tuto.language.shortname }</div>
                    {tuto.tags.map(t =>
                        <button
                           key={t.id}
                           className="badge text-xs badge-outline hover:text-secondary transition ease duration-150">
                            { t.title }
                        </button>
                    )}
                </div>

                <div className="card-actions justify-start text-xs text-neutral-400">
                    <span>Ajouté par { tuto.published_by.username } le { tuto.publishedAtLocal }</span>
                </div>
            </div>
        </div>
    );
};

export default LinkCard;