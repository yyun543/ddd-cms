<?php

namespace App\Infrastructure\Domain\Site\Repository;

use App\Domain\Site\Entity\Site;
use App\Domain\Site\Exception\SiteNotFoundException;
use App\Domain\Site\Repository\SiteRepository;
use App\Domain\Site\ValueObject\SiteIdentity;
use Doctrine\ORM\EntityRepository;

class DoctrineSiteRepository extends EntityRepository implements SiteRepository
{
    public function getOneById(SiteIdentity $siteIdentity): Site
    {
        $site = $this->findOneById($siteIdentity);

        if ($site === null) {
            throw  SiteNotFoundException::fromSiteId($siteIdentity);
        }

        return $site;
    }

    public function findOneById(SiteIdentity $siteIdentity): ?Site
    {
        return $this->createQueryBuilder('site')
            ->where('site.id = :id')
            ->setParameter('id', $siteIdentity->id())
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function add(Site $site): void
    {
        $this->getEntityManager()->persist($site);
        $this->getEntityManager()->flush($site);
    }

    public function nextIdentity(): SiteIdentity
    {
        return SiteIdentity::instance();
    }
}
