<?php

namespace NB\MediaBundle\Controller;

use NB\CommonBundle\Util\Entity;
use NB\MediaBundle\Entity\TipoMedia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('MediaBundle:Default:index.html.twig');
    }

    public function fileSendAction($type, $entityName, $entityId, $isActive) {
        $manager = $this->get('nb.manager');
        $em = $this->getDoctrine()->getManager();
        $result = [];

        if (!empty($_FILES['file'])) {
            $file = $_FILES['file'];

            try {
                $media = $this->get('nb.media.manager')->asyncFileSend($file, $type, $entityName, $entityId, $isActive);
            } catch (\Exception $e) {
                return $manager->renderJson(['fail' => $e->getMessage()]);
            }

            $result = $em->getRepository(Entity::MEDIA)
                ->hidrateByOption($entityId, $entityName, null, $isActive, true, $media->getId())[0];
        }

        return empty($file) ? $manager->renderJson(['fail' => 'No se ha enviado el archivo'])
            : $manager->renderJson(['success' => $result]);
    }

    public function fileSendAceptMultipleAction($type, $entityName, $entityId, $isActive) {
        $manager = $this->get('nb.manager');
        $em = $this->getDoctrine()->getManager();
        $result = [];

        if (!empty($_FILES['file'])) {
            $file = $_FILES['file'];
            try {
                $media = $this->get('nb.media.manager')->asyncFileSendAceptMultiple($file, $type, $entityName, $entityId, $isActive);
            } catch (\Exception $e) {
                return $manager->renderJson(['fail' => $e->getMessage()]);
            }

            $result = $em->getRepository(Entity::MEDIA)
                ->hidrateByOption($entityId, $entityName, null, $isActive, true, $media->getId())[0];
        }

        return empty($file) ? $manager->renderJson(['fail' => 'No se ha enviado el archivo'])
            : $manager->renderJson(['success' => $result]);
    }

    public function fileSendAppAction(Request $request) {
        $manager = $this->get('nb.manager');
        if (!empty($_FILES['file'])) {
            $extension = $_FILES['file']['type'];
            $target_path = $this->get('nb.media.file.uploader')->getTargetDir();
            $filename = md5(uniqid()) . '.' . $extension;
            $target_path = $target_path . '/' . $filename;
            try {
                move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
                $media = $this->get('nb.media.manager')->fileSendApp($filename, $request->get('type'), $request->get('entityName'), $request->get('entityId'), $request->get('isActive'));
            } catch (\Exception $e) {
                return $manager->renderJson(['fail' => $e->getMessage()]);
            }
            return $manager->renderJson(['path' => $media->getPath()]);
        } else {
            return $manager->renderJson(['fail' => 'No se ha enviado el archivo']);
        }
    }
}
