<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 08/09/2017
 * Time: 10:40
 */

namespace NB\CommonBundle\Manager;

use NB\CommonBundle\Util\Util;
use NB\MediaBundle\Entity\TipoMedia;

class NomenclatureManager extends Manager {

    public function save($data, \Closure $beforeFlush = null) {

        if (!empty($data['nbFullEntityName'])) {
            $fullEntityName = $data['nbFullEntityName'];
        } else {
            throw new \InvalidArgumentException('The nbFullEntityName key in $data var is not present');
        }

        $entity = new $fullEntityName();

        $this->getConnection()->transactional(function () use ($entity, $data, $beforeFlush) {
            $em = $this->getEntityManager();

            $exist = $this->get('nb.entitysetter')->fromData($entity, $data);

            if (!empty($beforeFlush)) {
                $beforeFlush($entity, $data);
            }

            $em->persist($entity);
            $em->flush($entity);

            if ($exist == false) {
                $em->persist($entity->getEl());
            }
            $em->flush();
        });

        return $entity;
    }


    public function edit($entity, $data, $existe = null, \Closure $beforeFlush = null) {
        $this->getConnection()->transactional(function () use ($entity, $data, $existe, $beforeFlush) {

            $em = $this->getEntityManager();
            $existe = !is_null($existe) ? $existe : $this->get('nb.entitysetter')->fromData($entity, $data);

            if (!empty($beforeFlush)) {
                $beforeFlush($entity, $data);
            }

            if ($existe == false) {
                $em->persist($entity->getEl());
            }

            $em->flush();
        });
    }

    public function remove($entity, \Closure $beforeFlush = null) {
        $this->getConnection()->transactional(function () use ($entity, $beforeFlush) {
            $em = $this->getEntityManager();

            $hasEl = method_exists($entity, 'getEl') && method_exists($entity, 'setEl');

            if ($hasEl) {
                $entityName = Util::getClass($entity);
                $simpleEntityName = lcfirst(Util::getClass($entity, false));

                $langs = $em->getRepository($entityName . 'Lang')->findBy([$simpleEntityName => $entity]);
                if (!empty($langs)) {
                    foreach ($langs as $item) {
                        $em->remove($item);
                        $em->flush($item);
                    }
                }
            }

            $hasEN = method_exists($entity, 'getEntityName');

            if ($hasEN) {
                $mediaManager = $this->get('nb.media.manager');
                $media = $mediaManager->findOne($entity, TipoMedia::IMAGEN);
                if (!empty($media)) {
                    $mediaManager->remove($media);
                }
            }

            if (!empty($beforeFlush)) {
                $beforeFlush($entity);
            }

            $em->remove($entity);
            $em->flush($entity);
        });
    }
}