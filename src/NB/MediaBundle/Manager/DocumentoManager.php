<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 19/05/2018
 * Time: 7:32
 */

namespace NB\MediaBundle\Manager;


use NB\CommonBundle\Manager\Manager;
use NB\CommonBundle\Util\Entity;
use NB\MediaBundle\Entity\Documento;

class DocumentoManager extends Manager {

    public function asyncFileSend($file, $tipoMedia, $entityName, $entityId, $isActive, $toEntityId, $toEntityName) {
        $documento = new Documento();
        $this->getConnection()->transactional(function () use ($documento, $file, $tipoMedia, $entityName, $entityId, $isActive, $toEntityId, $toEntityName) {
            if (!empty($file)) {
                $media = $this->get('nb.media.manager')->asyncFileSend($file, $tipoMedia, $entityName, $entityId, $isActive);
                $documento->setMedia($media);
                $documento->setParaEntityId($toEntityId);
                $documento->setParaEntityName($toEntityName);

                $em = $this->getEntityManager();
                $em->persist($documento);
                $em->flush();
            }
        });
        return $documento;
    }

    public function asyncFileSendAceptMultiple($file, $tipoMedia, $entityName, $entityId, $isActive, $toEntityId, $toEntityName) {
        $documento = new Documento();
        $this->getConnection()->transactional(function () use ($documento, $file, $tipoMedia, $entityName, $entityId, $isActive, $toEntityId, $toEntityName) {
            if (!empty($file)) {
                $media = $this->get('nb.media.manager')->asyncFileSendAceptMultiple($file, $tipoMedia, $entityName, $entityId, $isActive);
                $documento->setMedia($media);
                $documento->setParaEntityId($toEntityId);
                $documento->setParaEntityName($toEntityName);

                $em = $this->getEntityManager();
                $em->persist($documento);
                $em->flush();
            }
        });
        return $documento;
    }

    public function hidrateByOption($ownerEntity, $toEntity, $tipoMedia = null, $isActive = true, $hidrate = true, $idMedia = null) {
        $em = $this->getEntityManager();
        return $em->getRepository(Entity::DOCUMENTO)->hidrateByOption($ownerEntity->getId(), $this->getEntityName($ownerEntity),
            $toEntity->getId(), $this->getEntityName($toEntity), $tipoMedia, $isActive, $hidrate, $idMedia);
    }

    public function hidrateById($ownerEntity, $toEntity, $idMedia, $isActive = true) {
        $em = $this->getEntityManager();
        $result = $em->getRepository(Entity::DOCUMENTO)->hidrateByOption($ownerEntity->getId(), $this->getEntityName($ownerEntity),
            $toEntity->getId(), $this->getEntityName($toEntity), null, $isActive, true, $idMedia);
        return !empty($result) ? $result[0] : [];
    }

    /**
     * @param $entity Demandante|Empresa|Cuidador|Servicio
     */
    public function remove($entity) {
        $this->getConnection()->transactional(function () use ($entity) {
            $em = $this->getEntityManager();

            $documentos = $em->getRepository(Entity::DOCUMENTO)->findBy([
                'paraEntityId' => $entity->getId(),
                'paraEntityName' => $this->getEntityName($entity),
            ]);

            $medias = [];
            foreach ($documentos as $item) {
                $medias[] = $item->getMedia();
                $em->remove($item);
            }
            $em->flush();

            foreach ($medias as $item) {
                $this->get('nb.media.manager')->remove($item);
            }
        });
    }
}