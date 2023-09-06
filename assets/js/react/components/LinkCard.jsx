import React from 'react';

const LinkCard = ({tuto, affCard}) => {

    return (
        <div className="card bg-base-100 shadow-md w-full" data-theme="tutomarks">
            <a href={ tuto.url } target="_blank" className="w-full inline-block cursor-pointer overflow-hidden rounded-tl-box rounded-tr-box">
                <img src={ tuto.img_large ? tuto.img_large : tuto.image ? `/uploads/images/${tuto.image}` : `/uploads/images/${tuto.category.image}` }
                     className="rounded-tl-box rounded-tr-box hover:scale-125 transition duration-500 w-full h-auto"
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
                    <div className="badge text-xs badge-accent">NEW</div>
                    <div className="badge text-xs badge-primary">{ tuto.language.shortname }</div>
                    {/*{% for tag in video.tags %}*/}
                    {/*<a href="#" className="badge text-xs badge-outline hover:text-secondary transition ease duration-150">{{ tag.title }}</a>*/}
                    {/*{% endfor %}*/}
                </div>

                <div className="card-actions justify-start text-xs text-neutral-400">
                    <span>Ajouté par { tuto.publishedBy} le { tuto.publishedAtLocal }</span>
                </div>
            </div>
        </div>
    );
};

export default LinkCard;